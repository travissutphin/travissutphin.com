#!/bin/bash
# Docker entrypoint script for Railway deployment
# Handles dynamic PORT configuration

set -e

# Railway provides PORT environment variable
if [ -n "$PORT" ]; then
    echo "Configuring Apache to listen on port $PORT"

    # Update Apache ports configuration
    sed -i "s/80/$PORT/g" /etc/apache2/ports.conf
    sed -i "s/:80/:$PORT/g" /etc/apache2/sites-available/000-default.conf
    sed -i "s/:80/:$PORT/g" /etc/apache2/sites-enabled/000-default.conf

    echo "Apache configured for port $PORT"
else
    echo "No PORT environment variable set, using default port 80"
fi

# Start Apache
echo "Starting Apache..."
exec apache2-foreground