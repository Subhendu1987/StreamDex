#!/bin/bash
clear
echo -e "\e[0m\c"

# ASCII Logo
echo "
   _____ _                            _____            
  / ____| |                          |  __ \           
 | (___ | |_ _ __ ___  __ _ _ __ ___ | |  | | _____  __ 
  \___ \| __| |__/ _ \/ _  |  _   _ \| |  | |/ _ \ \/ / 
  ____) | |_| | |  __/ (_| | | | | | | |__| |  __/>  <  
 |_____/ \__|_|  \___|\__,_|_| |_| |_|_____/ \___/_/\_\ 
        --- Created with Love for YOU ---
"

echo "
###############################################################################
#           StreamDex Installer Script v2.0.0
#   GitHub: https://github.com/Subhendu1987/StreamDex
#   Issues: https://github.com/Subhendu1987/StreamDex/issues
#   Requirements: bash, curl/wget, nginx, php8.1, ffmpeg, cloudflared
###############################################################################
"

export PATH=/usr/sbin:$PATH
export DEBIAN_FRONTEND=noninteractive
set -e

# Update and upgrade the system
echo "Updating package list and upgrading existing packages..."
sudo apt update && sudo apt upgrade -y


# Install Nginx
echo "Installing Nginx..."
sudo apt install nginx -y

# Install PHP and other dependencies
echo "Installing PHP, FFmpeg, and required dependencies..."
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install curl ffmpeg git php8.1-fpm php8.1-sqlite3 php8.1-gd php8.1-intl php8.1-mbstring -y

# Start and enable PHP service
echo "Starting and enabling PHP service..."
sudo systemctl start php8.1-fpm
sudo systemctl enable php8.1-fpm

# Configure Nginx for StreamDex
echo "Configuring Nginx for StreamDex..."
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

sudo systemctl restart nginx

# Set up StreamDex
echo "Setting up StreamDex..."
sudo rm -rf /var/www/html
sudo mkdir -p /var/www/html
sudo git clone https://github.com/Subhendu1987/StreamDex.git /var/www/html/
sudo chmod -R 777 /var/www/html/writable
sudo chmod -R 777 /var/www/html/.env

# Install and configure RTMP module
echo "Installing and configuring RTMP module for Nginx..."
sudo add-apt-repository universe -y
sudo apt install libnginx-mod-rtmp -y

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

sudo systemctl restart nginx

# Display installation completion message
LOCAL_IP=$(hostname -I | awk '{print $1}')
echo ""
echo "Installation complete!"
echo "Access StreamDex at: http://$LOCAL_IP"
echo "Default Username: admin"
echo "Default Password: 123456"
