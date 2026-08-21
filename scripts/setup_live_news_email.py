#!/usr/bin/env python3
"""
Interactive Setup Helper for Live News Email Alerts
Prompts for Gmail sender, recipient, and Google App Password via hidden input,
safely writes .env.local, and applies chmod 600 permissions.
"""

import os
import sys
import getpass

PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
ENV_LOCAL_PATH = os.path.join(PROJECT_ROOT, ".env.local")

def setup():
    print("=" * 60)
    print("Live News Email Alerts - Gmail SMTP Secure Configuration")
    print("=" * 60)
    print("NOTE: ONLY use a dedicated 16-character Google App Password.")
    print("Do NOT enter your normal personal Gmail account password.")
    print("-" * 60)

    sender = input("Gmail Sender Address (e.g. your_email@gmail.com): ").strip()
    if not sender:
        print("ERROR: Sender address cannot be empty.", file=sys.stderr)
        sys.exit(1)

    recipient = input("Alert Recipient Email Address: ").strip()
    if not recipient:
        recipient = sender
        print(f"Using sender as recipient: {recipient}")

    app_password = getpass.getpass("Google App Password: ").strip().replace(" ", "")
    if not app_password:
        print("ERROR: Google App Password cannot be empty.", file=sys.stderr)
        sys.exit(1)

    env_lines = [
        "# Live News Gmail SMTP Configuration",
        "LIVE_NEWS_SMTP_HOST=smtp.gmail.com",
        "LIVE_NEWS_SMTP_PORT=587",
        "LIVE_NEWS_SMTP_SECURITY=STARTTLS",
        f"LIVE_NEWS_SMTP_USERNAME={sender}",
        f"LIVE_NEWS_SMTP_PASSWORD={app_password}",
        f"LIVE_NEWS_SMTP_FROM={sender}",
        f"LIVE_NEWS_ALERT_EMAIL={recipient}",
    ]

    with open(ENV_LOCAL_PATH, "w", encoding="utf-8") as f:
        f.write("\n".join(env_lines) + "\n")

    os.chmod(ENV_LOCAL_PATH, 0o600)

    print("-" * 60)
    print("Configuration written to .env.local with mode 600 (owner read/write only).")
    print("=" * 60)

if __name__ == "__main__":
    setup()
