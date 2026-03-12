FROM php:8.2-apache

# Instalación de las dependencias del contenedor
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    gnupg

# Limpiamos la caché
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalamos las extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Activamos Apache mod_rewrite
RUN a2enmod rewrite

# Deshabilitar EnableSendfile y EnableMMAP para la estabilidad de los volúmenes de Docker
RUN echo "EnableSendfile Off" >> /etc/apache2/apache2.conf
RUN echo "EnableMMAP Off" >> /etc/apache2/apache2.conf

# Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalamos Node.js y NPM
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

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

# Arreglamos los permisos
RUN chown -R www-data:www-data /var/www/html

# Copiar y dar permisos al script de entrada
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Punto de entrada
ENTRYPOINT ["docker-entrypoint.sh"]

# El comando por defecto sigue siendo apache2-foreground
CMD ["apache2-foreground"]

# Exponemos el puerto 80 HTTP
EXPOSE 80
