FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip bcmath

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

# Copia arquivos do projeto para dentro do container
COPY . .

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Define permissões para o diretório storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expõe a porta do servidor
EXPOSE 9000

# Comando de inicialização
CMD ["php-fpm"]
