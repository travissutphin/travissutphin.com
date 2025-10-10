#!/bin/bash
# Docker entrypoint script for Railway deployment
# Handles dynamic PORT configuration

set -e

# Output to both stdout and stderr to ensure Railway captures it
exec 1>&2

echo "========================================"
echo "RAILWAY ENTRYPOINT SCRIPT STARTING"
echo "========================================"
echo "Environment variables:"
echo "  PORT: ${PORT:-not set}"
echo "  RAILWAY_ENVIRONMENT: ${RAILWAY_ENVIRONMENT:-not set}"
echo "  PWD: $(pwd)"
echo "  USER: $(whoami)"
echo "========================================"

# Default to port 80 if PORT not set
PORT=${PORT:-80}

echo "=== Configuring Apache to listen on port $PORT ==="

# Update ports.conf to listen on all interfaces (0.0.0.0)
# This is critical for Railway to reach the application
echo "Listen 0.0.0.0:$PORT" > /etc/apache2/ports.conf

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

echo "=== Apache Configuration Complete ==="
echo "Testing Apache configuration..."

# Test Apache configuration
if apache2ctl configtest 2>&1; then
    echo "✓ Apache configuration is valid"
else
    echo "✗ Apache configuration has errors"
    exit 1
fi

# Show what port Apache will listen on
echo "=== Apache will listen on port $PORT ==="
echo "Document root: /var/www/html/public"
echo "ServerName: localhost"

# Verify document root exists and has content
if [ -d "/var/www/html/public" ]; then
    echo "✓ Document root exists"
    ls -la /var/www/html/public | head -5
else
    echo "✗ Document root missing!"
    exit 1
fi

# Create diagnostic file for Railway debugging
echo "=== Creating diagnostic file ==="
cat > /var/www/html/public/railway-diagnostics.txt <<DIAGEOF
Railway Deployment Diagnostics
================================
Generated: $(date)
PORT: $PORT
RAILWAY_ENVIRONMENT: ${RAILWAY_ENVIRONMENT:-not set}
PWD: $(pwd)
USER: $(whoami)

Apache Configuration:
- Listening on: 0.0.0.0:$PORT
- Document Root: /var/www/html/public
- VirtualHost: *:$PORT

Ports.conf content:
$(cat /etc/apache2/ports.conf)

VirtualHost config:
$(cat /etc/apache2/sites-available/000-default.conf)

Entrypoint script executed successfully.
If you can see this file, Apache is serving files correctly.
DIAGEOF

echo "✓ Diagnostic file created at /var/www/html/public/railway-diagnostics.txt"

# Start Apache
echo "=== Starting Apache in foreground mode ==="
exec apache2-foreground