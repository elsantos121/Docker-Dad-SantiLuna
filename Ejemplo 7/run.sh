#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")"
echo "*** Levantando LEMP (ejem07) con Docker Compose ***"
docker compose up -d --build
echo "*** Listo ***"
echo "App:         http://localhost:8880/"
echo "phpMyAdmin:  http://localhost:8881/"
echo "MariaDB (host): localhost:3307"
