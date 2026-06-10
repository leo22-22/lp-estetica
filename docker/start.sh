#!/bin/bash
set -e

echo "==> Gerando APP_KEY se necessário..."
php artisan key:generate --force 2>/dev/null || true

echo "==> Rodando migrations..."
php artisan migrate --force

echo "==> Limpando caches..."
php artisan optimize:clear
php artisan optimize

echo "==> Iniciando serviços..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
