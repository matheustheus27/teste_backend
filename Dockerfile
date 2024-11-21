# Dockerfile
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install zip pdo_mysql mbstring

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do Laravel
COPY . .

# Instalar as dependências do Laravel
RUN composer install

# Dar permissão ao diretório de armazenamento
RUN chown -R www-data:www-data /var/www/storage

# Expor a porta 9000
EXPOSE 8000

CMD ["php-fpm"]
