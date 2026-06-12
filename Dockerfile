FROM php:8.2-fpm-alpine

# Instalación de las dependencias del contenedor
RUN apk update && apk add --no-cache \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    gnupg \
    nodejs \
    npm \
    linux-headers \
    build-base

# Instalamos las extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuramos el directorio de alojamiento
WORKDIR /var/www/html

# Copiamos los archivos de las dependencias
COPY composer.json composer.lock package.json package-lock.json ./

# Instalamos las dependencias de PHP via Composer
RUN composer install --no-interaction --no-scripts --no-autoloader --prefer-dist

# Instalamos las dependencias de Node.js
RUN npm install

# Copiamos el resto de la aplicación
COPY . .

# Último proceso de composer (generamos un autoloader)
RUN composer dump-autoload

# Arreglamos los permisos (en alpine el usuario de php-fpm es www-data o root, pero por defecto suele ser www-data si se crea)
# En la imagen oficial fpm-alpine, el usuario es www-data (uid 82)
RUN chown -R www-data:www-data /var/www/html

# Copiar y dar permisos al script de entrada
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Punto de entrada
ENTRYPOINT ["docker-entrypoint.sh"]

# El comando por defecto para fpm es php-fpm
CMD ["php-fpm"]

# Exponemos el puerto 9000 para FastCGI
EXPOSE 9000
