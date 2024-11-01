# Use Ubuntu as the base image
FROM ubuntu:latest

# Set environment variables to prevent interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# Update and install necessary packages
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y nginx software-properties-common curl ffmpeg git && \
    apt-get install -y apt-utils && \
    apt-get install -y sudo

# Add PHP repository, update, and install PHP and extensions
RUN add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.1-fpm php8.1-sqlite3 php8.1-gd php8.1-intl php8.1-mbstring

# Write the NGINX site configuration directly into /etc/nginx/sites-available/default
RUN echo 'server {\n\
    listen 80;\n\
    server_name localhost;\n\
\n\
    root /var/www/html;\n\
    index index.php index.html index.htm;\n\
\n\
    client_max_body_size 100M;\n\
    location / {\n\
        try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
\n\
    location ~ \.php$ {\n\
        include snippets/fastcgi-php.conf;\n\
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;\n\
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n\
        include fastcgi_params;\n\
    }\n\
\n\
    location ~ /\.ht {\n\
        deny all;\n\
    }\n\
}\n' > /etc/nginx/sites-available/default

# Set the working directory to /var/www/html before cloning
WORKDIR /var/www/html
RUN rm -rf /var/www/html/* && \
    git clone https://github.com/Subhendu1987/StreamDex.git . && \
    chmod -R 777 /var/www/html/writable

# Set permissions for .env file
RUN touch /var/www/html/.env && chmod 666 /var/www/html/.env

# Add the universe repository and install the RTMP module for NGINX
RUN add-apt-repository universe && \
    apt-get update && \
    apt-get install -y libnginx-mod-rtmp

# Set permissions for NGINX configuration
RUN chown www-data:www-data /etc/nginx/nginx.conf && \
    chmod 664 /etc/nginx/nginx.conf

# Write the main NGINX configuration file directly into /etc/nginx/nginx.conf
RUN echo 'user www-data;\n\
worker_processes auto;\n\
pid /run/nginx.pid;\n\
error_log /var/log/nginx/error.log;\n\
include /etc/nginx/modules-enabled/*.conf;\n\
\n\
events {\n\
    worker_connections 768;\n\
}\n\
\n\
http {\n\
    sendfile on;\n\
    tcp_nopush on;\n\
    types_hash_max_size 2048;\n\
\n\
    include /etc/nginx/mime.types;\n\
    default_type application/octet-stream;\n\
\n\
    ssl_protocols TLSv1 TLSv1.1 TLSv1.2 TLSv1.3;\n\
    ssl_prefer_server_ciphers on;\n\
\n\
    access_log /var/log/nginx/access.log;\n\
\n\
    include /etc/nginx/conf.d/*.conf;\n\
    include /etc/nginx/sites-enabled/*;\n\
}\n\
\n\
rtmp {\n\
    server {\n\
        listen 1935;\n\
        chunk_size 4096;\n\
\n\
        application live {\n\
            live on;\n\
            record off;\n\
\n\
            hls on;\n\
            hls_path /var/www/html/writable/uploads/hls/;\n\
            hls_fragment 3;\n\
            hls_playlist_length 10;\n\
\n\
            allow publish all;\n\
            allow play all;\n\
        }\n\
\n\
        application push {\n\
            live on;\n\
            record off;\n\
            push rtmp://localhost/live;\n\
        }\n\
    }\n\
}\n' > /etc/nginx/nginx.conf

# Give write permission
RUN chmod -R 777 /var/www/html/writable

# Expose HTTP and RTMP ports
EXPOSE 80 1935

# Start PHP-FPM and NGINX in the foreground using JSON syntax
CMD ["sh", "-c", "service php8.1-fpm start && nginx -g 'daemon off;'"]
