#!/usr/bin/env python3
"""
Live News Health Monitor
Executes scripts/check_live_news_health.py --json, evaluates overall status,
logs structured monitoring entries with log rotation, and returns standard exit codes.

Exit Codes:
  0 = HEALTHY (All providers healthy)
  1 = WARNING (One or more providers have warnings, none failing)
  2 = FAIL (One or more providers failed health check)
  3 = MONITOR/CHECKER ERROR (Subprocess failure or malformed JSON)
"""

import os
import sys
import json
import subprocess
import datetime

PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
CHECKER_PATH = os.path.join(PROJECT_ROOT, "scripts", "check_live_news_health.py")
DATA_DIR = os.path.join(PROJECT_ROOT, "data")
LOG_FILE = os.path.join(DATA_DIR, "live_news_health.log")
MAX_LOG_BYTES = 5 * 1024 * 1024  # 5 MB

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

def log_health_entry(entry_text, log_path=LOG_FILE):
    os.makedirs(os.path.dirname(log_path), exist_ok=True)
    rotate_log_if_needed(log_path)
    with open(log_path, "a", encoding="utf-8") as f:
        f.write(entry_text.strip() + "\n")

def format_log_entry(report, overall_status):
    now_str = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
    summary = report.get("summary", {})
    total = summary.get("total_providers", len(report.get("providers", [])))
    healthy = summary.get("healthy", 0)
    warning = summary.get("warning", 0)
    fail = summary.get("fail", 0)

    entry = f"[{now_str}] STATUS={overall_status} providers={total} healthy={healthy} warning={warning} fail={fail}"

    problematic = []
    for p in report.get("providers", []):
        p_status = p.get("status", "HEALTHY")
        if p_status in ("WARNING", "FAIL"):
            p_name = p.get("provider", "unknown")
            p_fresh = p.get("freshness", "UNKNOWN")
            p_age = p.get("age_human", "unknown")
            p_vis = p.get("visual_type", "UNKNOWN")
            issues = "; ".join(p.get("issues", []))
            p_str = f"provider={p_name} status={p_status} freshness={p_fresh} age={p_age} visual={p_vis}"
            if issues:
                p_str += f' reason="{issues}"'
            problematic.append(p_str)

    if problematic:
        entry += " issues=[" + " | ".join(problematic) + "]"

    return entry

def evaluate_report(report):
    summary = report.get("summary", {})
    fail_count = summary.get("fail", 0)
    warning_count = summary.get("warning", 0)

    if "fail" not in summary or "warning" not in summary:
        fail_count = 0
        warning_count = 0
        for p in report.get("providers", []):
            st = p.get("status", "HEALTHY")
            if st == "FAIL":
                fail_count += 1
            elif st == "WARNING":
                warning_count += 1

    if fail_count > 0:
        return "FAIL", 2
    elif warning_count > 0:
        return "WARNING", 1
    else:
        return "HEALTHY", 0

def run_monitor(checker_path=CHECKER_PATH, log_path=LOG_FILE):
    if not os.path.exists(checker_path):
        now_str = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
        err_msg = f'[{now_str}] STATUS=ERROR error="Health checker script not found at {checker_path}"'
        log_health_entry(err_msg, log_path)
        print(f"ERROR: Health checker script not found at {checker_path}", file=sys.stderr)
        return 3

    try:
        proc = subprocess.run(
            [sys.executable, checker_path, "--json"],
            capture_output=True,
            text=True,
            timeout=30
        )
    except subprocess.TimeoutExpired:
        now_str = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
        err_msg = f'[{now_str}] STATUS=ERROR error="Health checker timed out after 30s"'
        log_health_entry(err_msg, log_path)
        print("ERROR: Health checker timed out after 30s", file=sys.stderr)
        return 3
    except Exception as e:
        now_str = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
        err_msg = f'[{now_str}] STATUS=ERROR error="Failed to execute health checker: {e}"'
        log_health_entry(err_msg, log_path)
        print(f"ERROR: Failed to execute health checker: {e}", file=sys.stderr)
        return 3

    raw_stdout = proc.stdout.strip()
    if not raw_stdout:
        now_str = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
        err_msg = f'[{now_str}] STATUS=ERROR error="Health checker produced empty output (exit {proc.returncode})"'
        log_health_entry(err_msg, log_path)
        print("ERROR: Health checker produced empty output", file=sys.stderr)
        return 3

    try:
        report = json.loads(raw_stdout)
    except json.JSONDecodeError as e:
        now_str = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
        err_msg = f'[{now_str}] STATUS=ERROR error="Malformed JSON from health checker: {e}"'
        log_health_entry(err_msg, log_path)
        print(f"ERROR: Malformed JSON from health checker: {e}", file=sys.stderr)
        return 3

    if not isinstance(report, dict) or "providers" not in report:
        now_str = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
        err_msg = f'[{now_str}] STATUS=ERROR error="Invalid report format from health checker"'
        log_health_entry(err_msg, log_path)
        print("ERROR: Invalid report format from health checker", file=sys.stderr)
        return 3

    status, exit_code = evaluate_report(report)
    log_entry = format_log_entry(report, status)
    log_health_entry(log_entry, log_path)

    print(f"LIVE NEWS MONITOR: STATUS={status} (Exit Code: {exit_code})")
    print(log_entry)

    return exit_code

def main():
    exit_code = run_monitor()
    sys.exit(exit_code)

if __name__ == "__main__":
    main()
