# Dockerfile for travissutphin.com
# Simplified for Railway deployment
# Version: 2.0.0
# Team: [Flow], [Gordon], [Syntax]

FROM php:8.2-cli

# Install minimal dependencies
RUN apt-get update && apt-get install -y \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Ensure proper permissions
RUN chmod -R 755 /var/www/html

# Expose port (Railway will use PORT env var)
EXPOSE 8080

# Labels
LABEL maintainer="[Flow] <devops@travissutphin.com>" \
      version="2.0.0" \
      description="travissutphin.com personal website"

# Enable error logging to stderr so Railway can capture it
RUN echo "error_log = /dev/stderr" >> /usr/local/etc/php/php.ini-production && \
    echo "log_errors = On" >> /usr/local/etc/php/php.ini-production && \
    echo "display_errors = Off" >> /usr/local/etc/php/php.ini-production && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Use PHP built-in server with error logging
CMD php -S 0.0.0.0:${PORT:-8080} -t public 2>&1