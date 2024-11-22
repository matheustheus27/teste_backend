# Usar a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar dependências do PHP e outras ferramentas necessárias para o Composer
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Habilitar mod_rewrite para o Laravel
RUN a2enmod rewrite

# Configurar o DocumentRoot do Apache para a pasta public do Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Definir o diretório de trabalho para a aplicação Laravel
WORKDIR /var/www/html

# Copiar o arquivo composer.lock e composer.json para a imagem
COPY composer.json composer.lock /var/www/html/

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Rodar o composer install para instalar as dependências do Laravel
RUN composer install --no-scripts --no-autoloader

# Copiar os arquivos do projeto para o contêiner
COPY . /var/www/html

# Rodar o composer dump-autoload para garantir que todos os arquivos estejam atualizados
RUN composer dump-autoload --optimize

# Dar permissão ao diretório storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 80 para o Apache
EXPOSE 80

# Comando para rodar o servidor Apache
CMD ["apache2-foreground"]
