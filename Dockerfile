# use PHP 8.2
FROM php:8.2-fpm

# Get args from docker-comppose.yml
ARG user
ARG uid

# Install common php extension dependencies
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip

# Install mysqli php extension
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Set the working directory
COPY . /var/www/app
WORKDIR /var/www/app

# Add [sikep] user to system
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

RUN mkdir /var/www/app/storage/app/public/Dokumen-Pendukung/

# Change owner of the app directory & set permision storage directory
RUN chown -R sikep:sikep /var/www/app \
    && chmod -R 775 /var/www/app/storage

# install composer
COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer

# Mount storage from host
ADD ./storage /var/www/app/storage
# Change owner of the storage
RUN chown -R sikep:sikep /var/www/app/storage

# Set current user to [sikep]
USER $user

# install the aplication
RUN composer install && \
    # php artisan storage:link && \
    php artisan key:generate && \
    npm install && \
    npm run build

# Set the default command to run php-fpm
CMD ["php-fpm"]