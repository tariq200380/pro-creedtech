@echo off
title Creed Tech Local Server
echo ========================================================
echo   Starting Creed Tech Enterprise Server...
echo ========================================================
echo.
cd /d "%~dp0"
start http://localhost:3000
node preview-server.mjs
pause
