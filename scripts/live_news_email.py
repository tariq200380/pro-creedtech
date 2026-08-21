#!/usr/bin/env python3
"""
Live News Email Notification Module
Sends email notifications for new Live News alert and recovery events.
Loads credentials strictly from environment variables.
Supports secure SMTP (STARTTLS / SSL) with dry-run support and isolated failure handling.
"""

import os
import sys
import ssl
import smtplib
import argparse
from email.message import EmailMessage

PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SMTP_TIMEOUT_SECONDS = 12

def load_private_env():
    for fname in [".env.local", ".env"]:
        env_path = os.path.join(PROJECT_ROOT, fname)
        if os.path.exists(env_path):
            try:
                with open(env_path, "r", encoding="utf-8") as f:
                    for line in f:
                        line = line.strip()
                        if line and not line.startswith("#") and "=" in line:
                            k, v = line.split("=", 1)
                            k = k.strip()
                            v = v.strip().strip("\"'")
                            if k and k not in os.environ:
                                os.environ[k] = v
            except Exception:
                pass

def get_email_config():
    load_private_env()
    return {
        "host": os.environ.get("LIVE_NEWS_SMTP_HOST", "smtp.gmail.com").strip(),
        "port": int(os.environ.get("LIVE_NEWS_SMTP_PORT", "587").strip() or 587),
        "username": os.environ.get("LIVE_NEWS_SMTP_USERNAME", "").strip(),
        "password": os.environ.get("LIVE_NEWS_SMTP_PASSWORD", "").strip(),
        "from_addr": os.environ.get("LIVE_NEWS_SMTP_FROM", "").strip(),
        "to_addr": os.environ.get("LIVE_NEWS_ALERT_EMAIL", "").strip(),
        "security": os.environ.get("LIVE_NEWS_SMTP_SECURITY", "STARTTLS").strip().upper(),
    }

def validate_email_config(config=None):
    if config is None:
        config = get_email_config()
    missing = []
    if not config.get("host"): missing.append("LIVE_NEWS_SMTP_HOST")
    if not config.get("username"): missing.append("LIVE_NEWS_SMTP_USERNAME")
    if not config.get("password"): missing.append("LIVE_NEWS_SMTP_PASSWORD")
    if not config.get("from_addr"): missing.append("LIVE_NEWS_SMTP_FROM")
    if not config.get("to_addr"): missing.append("LIVE_NEWS_ALERT_EMAIL")
    return len(missing) == 0, missing

def format_email_subject(alert_data):
    severity = alert_data.get("severity", "ALERT").upper()
    if severity == "WARNING":
        return "[Live News WARNING] Provider health issue"
    elif severity == "FAIL":
        return "[Live News FAIL] Provider failure detected"
    elif severity == "CRITICAL":
        return "[Live News CRITICAL] Monitoring error"
    elif severity == "RECOVERY":
        return "[Live News RECOVERY] Provider recovered"
    return f"[Live News {severity}] Status update"

def format_email_body(alert_data):
    severity = alert_data.get("severity", "UNKNOWN").upper()
    ts = alert_data.get("timestamp", "Unknown Time")
    status = alert_data.get("overall_status", "UNKNOWN")

    lines = [
        "=" * 60,
        f"LIVE NEWS HEALTH ALERT: {severity}",
        "=" * 60,
        f"Timestamp:      {ts}",
        f"Overall Status: {status}",
        f"Severity:       {severity}",
        "-" * 60,
    ]

    if severity == "CRITICAL":
        err = alert_data.get("error", "Unknown monitor error")
        lines.append(f"Error Detail:   {err}")
    elif severity == "RECOVERY":
        msg = alert_data.get("message", "Recovery recorded")
        lines.append(f"Summary:        {msg}")
        lines.append("")
        recovered = alert_data.get("recovered_providers", [])
        for rec in recovered:
            p_name = rec.get("provider", "unknown")
            prev_st = rec.get("previous_status", "UNKNOWN")
            curr_st = rec.get("current_status", "HEALTHY")
            rec_at = rec.get("recovered_at", ts)
            lines.append(f"  • Provider: {p_name} | Previous: {prev_st} -> Current: {curr_st} | Recovered at: {rec_at}")
        if not recovered and alert_data.get("recovered_component"):
            lines.append(f"  • Component: {alert_data.get('recovered_component')} recovered")
    else:
        # WARNING or FAIL
        total = alert_data.get("total_providers", "N/A")
        healthy = alert_data.get("healthy_count", 0)
        warning = alert_data.get("warning_count", 0)
        fail = alert_data.get("fail_count", 0)
        lines.append(f"Providers:      Total: {total} | Healthy: {healthy} | Warning: {warning} | Fail: {fail}")
        lines.append("")
        lines.append("Problematic Providers:")
        for p in alert_data.get("problematic_providers", []):
            p_name = p.get("name", p.get("provider", "unknown"))
            p_st = p.get("status", "UNKNOWN")
            p_fresh = p.get("freshness", "UNKNOWN")
            p_age = p.get("article_age", "unknown")
            p_vis = p.get("visual_type", "UNKNOWN")
            p_reason = p.get("reason", "N/A")
            lines.append(f"  • Provider:     {p_name} ({p.get('provider', '')})")
            lines.append(f"    Status:       {p_st}")
            lines.append(f"    Freshness:    {p_fresh} (Age: {p_age})")
            lines.append(f"    Visual Type:  {p_vis}")
            lines.append(f"    Reason:       {p_reason}")
            lines.append("")

    lines.append("-" * 60)
    lines.append("This is an automated health alert from Creed Tech Live News Monitor.")
    lines.append("=" * 60)
    return "\n".join(lines)

def send_alert_email(alert_data, config=None, dry_run=False):
    if not isinstance(alert_data, dict):
        return {"status": "skipped", "reason": "Invalid alert data"}

    if config is None:
        config = get_email_config()

    subject = format_email_subject(alert_data)
    body = format_email_body(alert_data)

    is_valid, missing_vars = validate_email_config(config)
    if dry_run:
        return {
            "status": "dry_run",
            "subject": subject,
            "body": body,
            "config_valid": is_valid,
            "missing_variables": missing_vars
        }

    if not is_valid:
        return {
            "status": "skipped",
            "reason": f"SMTP configuration missing: {', '.join(missing_vars)}"
        }

    msg = EmailMessage()
    msg["Subject"] = subject
    msg["From"] = config["from_addr"]
    msg["To"] = config["to_addr"]
    msg.set_content(body)

    try:
        host = config["host"]
        port = config["port"]
        security = config.get("security", "STARTTLS")
        username = config["username"]
        password = config["password"]

        if security == "SSL" or port == 465:
            context = ssl.create_default_context()
            with smtplib.SMTP_SSL(host, port, timeout=SMTP_TIMEOUT_SECONDS, context=context) as server:
                if username and password:
                    server.login(username, password)
                server.send_message(msg)
        else:
            with smtplib.SMTP(host, port, timeout=SMTP_TIMEOUT_SECONDS) as server:
                if security != "NONE":
                    context = ssl.create_default_context()
                    server.starttls(context=context)
                if username and password:
                    server.login(username, password)
                server.send_message(msg)

        return {"status": "sent", "subject": subject}
    except Exception as e:
        # Failure isolation: never crash or leak credentials
        return {
            "status": "failed",
            "reason": f"SMTP delivery error: {type(e).__name__}"
        }

def send_test_email(config=None):
    if config is None:
        config = get_email_config()
    is_valid, missing_vars = validate_email_config(config)
    if not is_valid:
        return {
            "status": "skipped",
            "reason": f"SMTP configuration missing: {', '.join(missing_vars)}"
        }

    msg = EmailMessage()
    msg["Subject"] = "CreedTech Live News Alert Test"
    msg["From"] = config["from_addr"]
    msg["To"] = config["to_addr"]
    msg.set_content(
        "Live News email alerts are configured successfully.\n\n"
        "This is a one-time SMTP test.\n\n"
        "No news problem has been detected."
    )

    try:
        host = config["host"]
        port = config["port"]
        security = config.get("security", "STARTTLS")
        username = config["username"]
        password = config["password"]

        if security == "SSL" or port == 465:
            context = ssl.create_default_context()
            with smtplib.SMTP_SSL(host, port, timeout=SMTP_TIMEOUT_SECONDS, context=context) as server:
                if username and password:
                    server.login(username, password)
                server.send_message(msg)
        else:
            with smtplib.SMTP(host, port, timeout=SMTP_TIMEOUT_SECONDS) as server:
                if security != "NONE":
                    context = ssl.create_default_context()
                    server.starttls(context=context)
                if username and password:
                    server.login(username, password)
                server.send_message(msg)

        return {"status": "sent", "subject": "CreedTech Live News Alert Test"}
    except Exception as e:
        return {
            "status": "failed",
            "reason": f"SMTP delivery error: {type(e).__name__}"
        }

def main():
    parser = argparse.ArgumentParser(description="Live News Email Notification Tool")
    parser.add_argument("--dry-run", action="store_true", help="Run in dry-run mode without sending email")
    parser.add_argument("--test-email", action="store_true", help="Send a one-time harmless test email")
    parser.add_argument("--severity", default="WARNING", choices=["WARNING", "FAIL", "CRITICAL", "RECOVERY"], help="Alert severity for testing")
    args = parser.parse_args()

    if args.test_email:
        res = send_test_email()
        print("=" * 40)
        print("LIVE NEWS TEST EMAIL RESULT:")
        print("=" * 40)
        print(f"Status: {res.get('status')}")
        if res.get("subject"):
            print(f"Subject: {res.get('subject')}")
        if res.get("reason"):
            print(f"Reason: {res.get('reason')}")
        return

    mock_alerts = {
        "WARNING": {
            "timestamp": "2026-08-22T04:00:00Z",
            "severity": "WARNING",
            "overall_status": "WARNING",
            "total_providers": 12,
            "healthy_count": 11,
            "warning_count": 1,
            "fail_count": 0,
            "problematic_providers": [
                {"provider": "microsoft", "name": "Microsoft News Center", "status": "WARNING", "freshness": "STALE", "article_age": "8.0 days", "visual_type": "SCREENSHOT", "reason": "Older than 7 days"}
            ]
        },
        "FAIL": {
            "timestamp": "2026-08-22T04:00:00Z",
            "severity": "FAIL",
            "overall_status": "FAIL",
            "total_providers": 12,
            "healthy_count": 11,
            "warning_count": 0,
            "fail_count": 1,
            "problematic_providers": [
                {"provider": "google", "name": "Google The Keyword", "status": "FAIL", "freshness": "FRESH", "article_age": "2 hours", "visual_type": "MISSING", "reason": "Article image missing from disk"}
            ]
        },
        "CRITICAL": {
            "timestamp": "2026-08-22T04:00:00Z",
            "severity": "CRITICAL",
            "overall_status": "ERROR",
            "error": "Health checker script timed out after 30s"
        },
        "RECOVERY": {
            "timestamp": "2026-08-22T04:00:00Z",
            "severity": "RECOVERY",
            "overall_status": "HEALTHY",
            "recovered_providers": [
                {"provider": "microsoft", "previous_status": "WARNING", "current_status": "HEALTHY", "recovered_at": "2026-08-22T04:00:00Z"}
            ],
            "message": "1 live news provider(s) recovered to HEALTHY"
        }
    }

    alert = mock_alerts.get(args.severity, mock_alerts["WARNING"])
    res = send_alert_email(alert, dry_run=args.dry_run)
    print("=" * 40)
    print("LIVE NEWS EMAIL RESULT:")
    print("=" * 40)
    print(f"Status: {res.get('status')}")
    if args.dry_run:
        print(f"Subject: {res.get('subject')}")
        print(f"Config Valid: {res.get('config_valid')}")
        if res.get("missing_variables"):
            print(f"Missing Config: {', '.join(res.get('missing_variables'))}")
        print("-" * 40)
        print("Email Body:")
        print(res.get("body"))
    else:
        if res.get("reason"):
            print(f"Reason: {res.get('reason')}")

if __name__ == "__main__":
    main()
