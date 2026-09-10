@echo off
title Creed Tech Local Server
echo ========================================================
echo   Starting Creed Tech Enterprise Server...
echo ========================================================
echo.
cd /d "%~dp0"
echo Starting backend server and PHP runtime...
start "" node preview-server.mjs
timeout /t 2 /nobreak >nul
start http://localhost:3001
echo Server is running. Close this window to stop.
pause
