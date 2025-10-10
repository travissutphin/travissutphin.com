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

# Set ServerName to suppress Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure Apache to use Railway's PORT environment variable
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure Apache to listen on Railway's PORT (defaults to 80 for local development)
RUN sed -i 's/Listen 80/Listen ${PORT:-80}/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:${PORT:-80}/' /etc/apache2/sites-available/000-default.conf

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

# Copy and set up entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/content

# Health check (using PORT environment variable)
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:${PORT:-80}/ || exit 1

# Expose port (Railway sets this dynamically)
EXPOSE ${PORT:-80}

# Labels for Railway and container metadata
LABEL maintainer="[Flow] <devops@travissutphin.com>" \
      version="1.0.0" \
      description="travissutphin.com personal website" \
      team="[Flow], [Gordon], [Syntax]"

# Use entrypoint script to handle Railway PORT configuration
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]