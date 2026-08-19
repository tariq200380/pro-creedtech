@echo off
title Creed Tech - Push to GitHub
cd /d "%~dp0"
echo ========================================================
echo   Creed Tech Enterprise - Push to GitHub Repository
echo ========================================================
echo.

git add .
git commit -m "feat: complete Enterprise PHP CMS, Security Center, Rich Studio & Live Dynamic Integrations"
git branch -M main
git remote remove origin >nul 2>&1
git remote add origin https://github.com/tariq200380/creed-tech.git
echo.
echo Pushing latest code to GitHub repository...
echo https://github.com/tariq200380/creed-tech
echo.
git push -u origin main

echo.
echo ========================================================
echo   Git Push Process Completed!
echo ========================================================
pause
