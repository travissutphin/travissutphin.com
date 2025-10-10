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

# Use PHP built-in server - simple and works perfectly for this use case
CMD php -S 0.0.0.0:${PORT:-8080} -t public