
FROM php:8.2-apache

# Install trusted CA certificates for secure TiDB Cloud connections
RUN apt-get update \
    && apt-get install -y --no-install-recommends ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Install PHP MySQLi extension
RUN docker-php-ext-install mysqli

# Render's default web service port
ENV PORT=10000

# Copy application files
COPY . /var/www/html/

# Set application permissions
RUN chown -R www-data:www-data /var/www/html

# Configure the Apache startup script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# Fix Windows line endings and make the script executable
RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 10000

CMD ["docker-entrypoint.sh"]
