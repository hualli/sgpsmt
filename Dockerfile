# Usamos la imagen oficial de PHP 8.3-FPM
FROM php:8.3-fpm

# Directorio de trabajo
WORKDIR /var/www/html

# Instalamos dependencias del sistema (para PHP y Node)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libgd-dev \
    libonig-dev \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalamos extensiones de PHP que Laravel necesita
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalamos Composer (última versión)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalamos Node.js 22 (para compilar assets)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
  && apt-get install -y nodejs

# Copiamos los archivos de la app
COPY . .

# Instalamos dependencias de Composer (sin dev)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Instalamos dependencias de NPM y compilamos (Vite)
RUN npm install
RUN npm run build

# Ajustamos permisos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
  && chmod -R 775 storage bootstrap/cache

# Exponemos el puerto de FPM
EXPOSE 9000