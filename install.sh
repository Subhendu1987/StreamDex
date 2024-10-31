#!/bin/bash

# Update and upgrade the package list
echo "Updating package list and upgrading existing packages..."
sudo apt update && sudo apt upgrade -y

# Install Nginx
echo "Installing Nginx..."
sudo apt install nginx -y

# Install required PHP and FFmpeg packages
echo "Installing PHP, FFmpeg, and other required packages..."
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install curl ffmpeg git php8.1-fpm php8.1-sqlite3 php8.1-gd php8.1-intl php8.1-mbstring -y

# Start and enable PHP
echo "Starting and enabling PHP service..."
sudo systemctl start php8.1-fpm
sudo systemctl enable php8.1-fpm

# Configure Nginx
echo "Configuring Nginx..."
NGINX_CONFIG_PATH="/etc/nginx/sites-available/default"
sudo tee $NGINX_CONFIG_PATH > /dev/null <<EOL
server {
    listen 80;
    server_name localhost;

    root /var/www/html;
    index index.php index.html index.htm;

    client_max_body_size 100M;
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
EOL

# Restart Nginx
echo "Restarting Nginx..."
sudo systemctl restart nginx

# Clone the StreamDex repository
echo "Cloning StreamDex repository..."
cd /var/www/html
sudo git clone https://github.com/Subhendu1987/StreamDex.git .

# Set writable permissions
echo "Setting writable permissions..."
sudo chmod -R 777 /var/www/html/writable
sudo chmod -R 777 /var/www/html/.env

# Install RTMP module for Nginx
echo "Installing RTMP module for Nginx..."
sudo add-apt-repository universe -y
sudo apt install libnginx-mod-rtmp -y

# Configure Nginx for RTMP streaming
echo "Configuring Nginx for RTMP..."
sudo chown www-data:www-data /etc/nginx/nginx.conf
sudo chmod 664 /etc/nginx/nginx.conf
NGINX_MAIN_CONFIG="/etc/nginx/nginx.conf"

sudo tee $NGINX_MAIN_CONFIG > /dev/null <<EOL
user www-data;
worker_processes auto;
pid /run/nginx.pid;
error_log /var/log/nginx/error.log;
include /etc/nginx/modules-enabled/*.conf;

events {
    worker_connections 768;
}

http {
    sendfile on;
    tcp_nopush on;
    types_hash_max_size 2048;

    include /etc/nginx/mime.types;
    default_type application/octet-stream;

    ssl_protocols TLSv1 TLSv1.1 TLSv1.2 TLSv1.3;
    ssl_prefer_server_ciphers on;

    access_log /var/log/nginx/access.log;

    include /etc/nginx/conf.d/*.conf;
    include /etc/nginx/sites-enabled/*;
}

rtmp {
    server {
        listen 1935;
        chunk_size 4096;

        application live {
            live on;
            record off;

            hls on;
            hls_path /var/www/html/writable/uploads/hls/;
            hls_fragment 3;
            hls_playlist_length 10;

            allow publish all;
            allow play all;
        }

        application push {
            live on;
            record off;
            push rtmp://localhost/live;
        }
    }
}
EOL

# Final Nginx restart
echo "Restarting Nginx..."
sudo systemctl restart nginx

echo "Installation complete!"
