FROM php:8.5-fpm-alpine

WORKDIR /var/www/html

# Dependências do sistema
RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    curl \
    zip \
    unzip \
    git \
    libxml2-dev \
    oniguruma-dev \
    libpq-dev

# Dependências para GD (processamento e validação de imagens)
RUN apk add --no-cache freetype-dev libjpeg-turbo-dev libpng-dev libwebp-dev

# Extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_pgsql mbstring pcntl bcmath gd exif

# Aumenta limites de upload (padrão Alpine PHP é 2MB)
RUN { \
    echo 'upload_max_filesize=15M'; \
    echo 'post_max_size=30M'; \
    echo 'memory_limit=256M'; \
} > /usr/local/etc/php/conf.d/uploads.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Arquivos da aplicação
COPY . .

# Instala dependências PHP (sem dev)
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Permissões de storage
RUN mkdir -p storage/logs storage/framework/cache/data \
        storage/framework/sessions storage/framework/views bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache public

# Config Nginx para produção
COPY docker/nginx/render.conf /etc/nginx/http.d/default.conf

# Config Supervisord
COPY docker/supervisord.conf /etc/supervisord.conf

COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
