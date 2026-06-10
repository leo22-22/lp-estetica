#!/bin/bash
set -e

echo "🌸 Eduarda Cardoso Estética – Setup Inicial"
echo "============================================="

# Copy .env
if [ ! -f .env ]; then
  cp .env.example .env
  echo "✅ .env criado a partir de .env.example"
fi

# Build e start containers
echo "🐳 Subindo containers Docker..."
docker-compose up -d --build

# Wait for MySQL
echo "⏳ Aguardando MySQL inicializar..."
sleep 10

# Install dependencies
echo "📦 Instalando dependências PHP..."
docker-compose exec app composer install

# Generate key
echo "🔑 Gerando APP_KEY..."
docker-compose exec app php artisan key:generate

# Run migrations
echo "🗃️  Rodando migrations..."
docker-compose exec app php artisan migrate --force

# Set permissions
echo "🔐 Ajustando permissões..."
docker-compose exec app chmod -R 775 storage bootstrap/cache

echo ""
echo "✅ Setup concluído!"
echo "🌸 Acesse: http://localhost:8080"
echo "📋 Admin:  http://localhost:8080/admin/contatos"
