# ==============================================================================
# Dockerfile: Aplicación PHP 8.3 con Apache (Base de Datos en la Nube)
# ==============================================================================

FROM php:8.3-apache

# Metadatos del contenedor
LABEL maintainer="Equipo de Desarrollo"
LABEL description="Contenedor de aplicación web con conexión a Base de Datos Cloud"

# Instalar dependencias del sistema y certificados CA para conexiones SSL a BD Cloud
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    unzip \
    libzip-dev \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias para MySQL y la lógica de dominio
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    bcmath \
    opcache

# Configuración de PHP para producción
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    { \
        echo 'memory_limit = 256M'; \
        echo 'upload_max_filesize = 64M'; \
        echo 'post_max_size = 64M'; \
        echo 'date.timezone = UTC'; \
        echo 'display_errors = Off'; \
        echo 'log_errors = On'; \
        echo 'error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT'; \
    } > "$PHP_INI_DIR/conf.d/custom.ini"

# Habilitar módulos de Apache requeridos (mod_rewrite y headers)
RUN a2enmod rewrite headers

# Configurar Apache para permitir directivas .htaccess (AllowOverride All)
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar el código fuente de la aplicación
COPY . /var/www/html/

# Ajustar permisos para el usuario www-data
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Puerto expuesto por Apache
EXPOSE 80

# Iniciar servidor web Apache
CMD ["apache2-foreground"]
