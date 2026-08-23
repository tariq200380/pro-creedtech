#!/usr/bin/env bash
set -e

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
cd "$DIR"

echo "========================================================"
echo "  Starting Creed Tech Enterprise Development Server..."
echo "  URL: http://localhost:3000"
echo "========================================================"
echo ""

node preview-server.mjs
