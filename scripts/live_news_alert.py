#!/usr/bin/env python3
"""
Live News Alert System
Evaluates Live News monitoring results, implements 24h deduplication and recovery tracking,
and appends compact structured JSON lines to data/live_news_alerts.log with log rotation.
"""

import os
import sys
import json
import datetime

PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DATA_DIR = os.path.join(PROJECT_ROOT, "data")
ALERT_LOG = os.path.join(DATA_DIR, "live_news_alerts.log")
STATE_FILE = os.path.join(DATA_DIR, "live_news_alert_state.json")
MAX_LOG_BYTES = 5 * 1024 * 1024  # 5 MB
DEDUP_WINDOW_SECONDS = 24 * 3600  # 24 hours

def rotate_log_if_needed(log_path, max_bytes=MAX_LOG_BYTES):
    if os.path.exists(log_path):
        try:
            if os.path.getsize(log_path) >= max_bytes:
                backup_path = log_path + ".1"
                if os.path.exists(backup_path):
                    try:
                        os.remove(backup_path)
                    except OSError:
                        pass
                os.rename(log_path, backup_path)
        except OSError:
            pass

def load_alert_state(state_path=STATE_FILE):
    if not os.path.exists(state_path):
        return {"last_updated": None, "active_issues": {}, "last_monitor_error": None}
    try:
        with open(state_path, "r", encoding="utf-8") as f:
            data = json.load(f)
            if isinstance(data, dict):
                if "active_issues" not in data:
                    data["active_issues"] = {}
                return data
    except Exception:
        pass
    return {"last_updated": None, "active_issues": {}, "last_monitor_error": None}

def save_alert_state(state, state_path=STATE_FILE):
    os.makedirs(os.path.dirname(state_path), exist_ok=True)
    tmp_path = state_path + ".tmp." + str(os.getpid())
    try:
        with open(tmp_path, "w", encoding="utf-8") as f:
            json.dump(state, f, indent=2)
        os.replace(tmp_path, state_path)
    except Exception:
        if os.path.exists(tmp_path):
            try:
                os.remove(tmp_path)
            except OSError:
                pass

def append_alert_log(alert_dict, log_path=ALERT_LOG):
    os.makedirs(os.path.dirname(log_path), exist_ok=True)
    rotate_log_if_needed(log_path)
    line = json.dumps(alert_dict, separators=(",", ":"))
    with open(log_path, "a", encoding="utf-8") as f:
        f.write(line + "\n")

def parse_iso_time(ts_str):
    if not ts_str:
        return None
    try:
        dt = datetime.datetime.fromisoformat(ts_str.replace("Z", "+00:00"))
        if dt.tzinfo is None:
            dt = dt.replace(tzinfo=datetime.timezone.utc)
        return dt
    except Exception:
        return None

def process_monitor_error(error_message, log_path=ALERT_LOG, state_path=STATE_FILE):
    now_dt = datetime.datetime.now(datetime.timezone.utc)
    now_iso = now_dt.strftime("%Y-%m-%dT%H:%M:%SZ")
    state = load_alert_state(state_path)

    prev_err = state.get("last_monitor_error")
    should_alert = True
    if prev_err and isinstance(prev_err, dict):
        if prev_err.get("error") == error_message:
            last_ts = parse_iso_time(prev_err.get("last_alerted_at"))
            if last_ts and (now_dt - last_ts).total_seconds() < DEDUP_WINDOW_SECONDS:
                should_alert = False

    if should_alert:
        alert = {
            "timestamp": now_iso,
            "severity": "CRITICAL",
            "overall_status": "ERROR",
            "error": error_message
        }
        append_alert_log(alert, log_path)
        state["last_monitor_error"] = {
            "error": error_message,
            "last_alerted_at": now_iso
        }
        state["last_updated"] = now_iso
        save_alert_state(state, state_path)
        return alert
    return None

def process_health_report(report, overall_status, log_path=ALERT_LOG, state_path=STATE_FILE):
    now_dt = datetime.datetime.now(datetime.timezone.utc)
    now_iso = now_dt.strftime("%Y-%m-%dT%H:%M:%SZ")
    state = load_alert_state(state_path)

    alerts_emitted = []
    active_issues = state.get("active_issues", {})

    # Check monitor error recovery
    if state.get("last_monitor_error") is not None:
        rec_err_alert = {
            "timestamp": now_iso,
            "severity": "RECOVERY",
            "overall_status": overall_status,
            "recovered_component": "monitor_checker",
            "message": "Health monitor and checker execution recovered to normal operation"
        }
        append_alert_log(rec_err_alert, log_path)
        alerts_emitted.append(rec_err_alert)
        state["last_monitor_error"] = None

    # Map current providers
    current_providers = {p.get("provider"): p for p in report.get("providers", []) if p.get("provider")}

    # 1. Check for Recoveries
    recovered_providers = []
    for p_key, prev_info in list(active_issues.items()):
        curr = current_providers.get(p_key)
        if curr and curr.get("status") == "HEALTHY":
            rec_item = {
                "provider": p_key,
                "previous_status": prev_info.get("status", "WARNING"),
                "current_status": "HEALTHY",
                "recovered_at": now_iso
            }
            recovered_providers.append(rec_item)
            del active_issues[p_key]

    if recovered_providers:
        recovery_alert = {
            "timestamp": now_iso,
            "severity": "RECOVERY",
            "overall_status": overall_status,
            "recovered_providers": recovered_providers,
            "message": f"{len(recovered_providers)} live news provider(s) recovered to HEALTHY"
        }
        append_alert_log(recovery_alert, log_path)
        alerts_emitted.append(recovery_alert)

    # 2. Check Problematic Providers (WARNING / FAIL)
    problem_candidates = []
    for p_key, curr in current_providers.items():
        c_status = curr.get("status", "HEALTHY")
        if c_status in ("WARNING", "FAIL"):
            c_issues = "; ".join(curr.get("issues", []))
            c_fresh = curr.get("freshness", "UNKNOWN")
            c_age = curr.get("age_human", "unknown")
            c_vis = curr.get("visual_type", "UNKNOWN")

            prev = active_issues.get(p_key)
            should_alert = False

            if prev is None:
                should_alert = True
            elif c_status == "FAIL" and prev.get("status") == "WARNING":
                should_alert = True
            elif c_issues != prev.get("reason"):
                should_alert = True
            else:
                last_ts = parse_iso_time(prev.get("last_alerted_at"))
                if not last_ts or (now_dt - last_ts).total_seconds() >= DEDUP_WINDOW_SECONDS:
                    should_alert = True

            if p_key not in active_issues:
                active_issues[p_key] = {
                    "status": c_status,
                    "reason": c_issues,
                    "freshness": c_fresh,
                    "visual_type": c_vis,
                    "first_detected_at": now_iso,
                    "last_alerted_at": now_iso if should_alert else now_iso
                }
            else:
                active_issues[p_key]["status"] = c_status
                active_issues[p_key]["reason"] = c_issues
                active_issues[p_key]["freshness"] = c_fresh
                active_issues[p_key]["visual_type"] = c_vis
                if should_alert:
                    active_issues[p_key]["last_alerted_at"] = now_iso

            if should_alert:
                problem_candidates.append({
                    "provider": p_key,
                    "name": curr.get("name", p_key),
                    "status": c_status,
                    "freshness": c_fresh,
                    "article_age": c_age,
                    "visual_type": c_vis,
                    "reason": c_issues
                })

    if problem_candidates:
        summary = report.get("summary", {})
        severity = "FAIL" if any(p["status"] == "FAIL" for p in problem_candidates) else "WARNING"
        problem_alert = {
            "timestamp": now_iso,
            "severity": severity,
            "overall_status": overall_status,
            "total_providers": summary.get("total_providers", len(current_providers)),
            "healthy_count": summary.get("healthy", 0),
            "warning_count": summary.get("warning", 0),
            "fail_count": summary.get("fail", 0),
            "problematic_providers": problem_candidates
        }
        append_alert_log(problem_alert, log_path)
        alerts_emitted.append(problem_alert)

    state["active_issues"] = active_issues
    state["last_updated"] = now_iso
    save_alert_state(state, state_path)

    return alerts_emitted
