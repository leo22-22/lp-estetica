#!/bin/bash
set -e

echo "==> Gerando APP_KEY se necessário..."
php artisan key:generate --force 2>/dev/null || true

echo "==> Aguardando banco de dados..."
MAX_TRIES=30
COUNT=0
until php artisan db:show 2>/dev/null || [ $COUNT -ge $MAX_TRIES ]; do
    COUNT=$((COUNT + 1))
    echo "    Tentativa $COUNT/$MAX_TRIES — aguardando DB..."
    sleep 2
done

echo "==> Rodando migrations..."
php artisan migrate --force

echo "==> Otimizando..."
php artisan optimize:clear
php artisan optimize

echo "==> Iniciando serviços..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
