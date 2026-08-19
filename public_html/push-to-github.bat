@echo off
title Creed Tech - Push to GitHub
cd /d "%~dp0"
echo ========================================================
echo   Creed Tech Enterprise - Push to GitHub Repository
echo ========================================================
echo.

git add .
git commit -m "feat: complete Enterprise PHP CMS, Security Center (GDPR, SOC 2, ISO 27001, PCI-DSS), Knowledge Center & responsive optimizations"
git branch -M main
git remote remove origin >nul 2>&1
git remote add origin https://github.com/tariq200380/pro-creedtech.git
echo.
echo Pushing latest code to GitHub repository...
echo https://github.com/tariq200380/pro-creedtech
echo.
git push -u origin main

echo.
echo ========================================================
echo   Git Push Process Completed!
echo ========================================================
pause
