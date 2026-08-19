#!/usr/bin/env bash
set -e
echo "========================================================"
echo "  Creed Tech Enterprise - Push to GitHub Repository"
echo "  Target: https://github.com/tariq200380/pro-creedtech.git"
echo "========================================================"
echo ""

git add .
git commit -m "feat: complete Enterprise PHP CMS, Security Center (GDPR, SOC 2, ISO 27001, PCI-DSS), Knowledge Center & responsive optimizations" || true
git branch -M main
git remote set-url origin https://github.com/tariq200380/pro-creedtech.git 2>/dev/null || git remote add origin https://github.com/tariq200380/pro-creedtech.git

echo ""
echo "Pushing latest code to GitHub repository..."
echo "https://github.com/tariq200380/pro-creedtech"
echo ""
git push -u origin main
echo ""
echo "========================================================"
echo "  Git Push Process Completed Successfully!"
echo "========================================================"
