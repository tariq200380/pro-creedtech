#!/usr/bin/env bash
set -e
cd /home/tariq/Desktop/CREED_TECH_LATEST_BACKUP_FOLDER

echo "====================================================="
echo "   CREED TECH - SET ADMIN PASSWORD PRIVATELY         "
echo "====================================================="
echo ""

read -rsp "Enter your desired admin password: " NEW_PASS
echo ""
read -rsp "Confirm your desired admin password: " CONFIRM_PASS
echo ""

if [ -z "$NEW_PASS" ]; then
    echo "[ERROR] Password cannot be empty!"
    exit 1
fi

if [ "$NEW_PASS" != "$CONFIRM_PASS" ]; then
    echo "[ERROR] Passwords do not match! Please run the script again."
    exit 1
fi

php -r '
$pass = $argv[1];
$hash = password_hash($pass, PASSWORD_ARGON2ID);
$store = [
    "200380tariq@gmail.com" => ["id" => 1, "email" => "200380tariq@gmail.com", "password_hash" => $hash, "role" => "admin", "status" => "ACTIVE", "created_at" => gmdate("Y-m-d H:i:s")],
    "tariq200380@gmail.com" => ["id" => 2, "email" => "tariq200380@gmail.com", "password_hash" => $hash, "role" => "admin", "status" => "ACTIVE", "created_at" => gmdate("Y-m-d H:i:s")],
    "tariq"                 => ["id" => 3, "email" => "tariq200380@gmail.com", "password_hash" => $hash, "role" => "admin", "status" => "ACTIVE", "created_at" => gmdate("Y-m-d H:i:s")],
    "admin"                 => ["id" => 4, "email" => "200380tariq@gmail.com", "password_hash" => $hash, "role" => "admin", "status" => "ACTIVE", "created_at" => gmdate("Y-m-d H:i:s")]
];
file_put_contents("data/admin_store.json", json_encode($store, JSON_PRETTY_PRINT));
file_put_contents("public_html/data/login_rate_limits.json", json_encode(["emails"=>[], "ips"=>[]], JSON_PRETTY_PRINT));
echo "\n>>> SUCCESS: Your password has been updated and rate limits reset!\n";
' "$NEW_PASS"

echo "You can now log in at http://localhost:3000/login"
echo "====================================================="
