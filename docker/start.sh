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

echo "==> Rodando migrations e seed..."
php artisan migrate --force
php artisan db:seed --force

echo "==> Criando symlink de storage..."
php artisan storage:link --force 2>/dev/null || true

echo "==> Otimizando..."
php artisan optimize:clear
php artisan optimize

echo "==> Ajustando permissões..."
chmod -R 777 storage bootstrap/cache

echo "==> Iniciando serviços..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
