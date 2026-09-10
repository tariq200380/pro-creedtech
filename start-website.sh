#!/usr/bin/env bash
set -e

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
cd "$DIR"

echo "========================================================"
echo "  Starting Creed Tech Enterprise Development Server..."
echo "  Next.js:  http://localhost:3001"
echo "  Proxy:    http://localhost:3000"
echo "========================================================"
echo ""

# 1. Ensure PostgreSQL is active on port 5433
PGDATA="/home/tariq/.gemini/antigravity/scratch/pgdata"
if [ -d "$PGDATA" ]; then
    if ! pg_isready -h "$PGDATA" -p 5433 >/dev/null 2>&1; then
        echo "[POSTGRES] Starting PostgreSQL daemon on port 5433..."
        /usr/lib/postgresql/18/bin/postgres -D "$PGDATA" -k "$PGDATA" -p 5433 >/dev/null 2>&1 &
        sleep 1
    else
        echo "[POSTGRES] PostgreSQL is already running on port 5433."
    fi
fi

# 2. Ensure enterprise-app Next.js is running on port 3001
ENT_APP="/home/tariq/.gemini/antigravity/scratch/enterprise-app"
if [ -d "$ENT_APP" ]; then
    if ! curl -s --connect-timeout 1 http://127.0.0.1:3001 >/dev/null 2>&1; then
        echo "[NEXT.JS] Starting enterprise-app on port 3001..."
        (cd "$ENT_APP" && npm run dev >/dev/null 2>&1 &)
        sleep 2
    else
        echo "[NEXT.JS] Enterprise app is already running on port 3001."
    fi
fi

# 3. Synchronize live news cache once in background
if [ -f "public_html/cron/import_news.php" ]; then
    (php public_html/cron/import_news.php >/dev/null 2>&1 &)
fi

echo "[READY] All services started. Starting PHP/Node proxy..."
node preview-server.mjs
