#!/bin/bash
# Docker entrypoint script for Railway deployment
# Handles dynamic PORT configuration

set -e

# Default to port 80 if PORT not set
PORT=${PORT:-80}

echo "Configuring Apache to listen on port $PORT"

# Update ports.conf to listen on the correct port
echo "Listen $PORT" > /etc/apache2/ports.conf

# Update the default virtual host
cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:$PORT>
    ServerName localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# Enable the site
a2ensite 000-default

echo "Apache configured for port $PORT"

# Start Apache
echo "Starting Apache..."
exec apache2-foreground