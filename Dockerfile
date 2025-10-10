# Dockerfile for travissutphin.com
# Production-ready PHP application with Apache
# Version: 1.0.0
# Team: [Flow], [Gordon], [Syntax]

FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && docker-php-ext-install opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Configure PHP
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Configure Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Create .htaccess for proper routing
RUN echo '<Directory ${APACHE_DOCUMENT_ROOT}>' > /etc/apache2/conf-available/override.conf && \
    echo '    AllowOverride All' >> /etc/apache2/conf-available/override.conf && \
    echo '    Require all granted' >> /etc/apache2/conf-available/override.conf && \
    echo '</Directory>' >> /etc/apache2/conf-available/override.conf && \
    a2enconf override

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/content

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Expose port 80
EXPOSE 80

# Labels for Railway and container metadata
LABEL maintainer="[Flow] <devops@travissutphin.com>" \
      version="1.0.0" \
      description="travissutphin.com personal website" \
      team="[Flow], [Gordon], [Syntax]"

# Start Apache in foreground
CMD ["apache2-foreground"]