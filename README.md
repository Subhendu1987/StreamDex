# StreamDex

**StreamDex** is a powerful RTMP (Real-Time Messaging Protocol) streaming application that allows users to create, manage, and stream live music videos seamlessly. With an intuitive interface and robust features, StreamDex is designed to enhance your live streaming experience.

## Features

- **Create Music Videos**: Easily create and manage your music video streams.
- **Audio Management**: Add, remove, and manage audio tracks for your streams.
- **Stream Links**: Generate and manage RTMP links for smooth streaming.
- **Playlist Management**: Create and edit playlists for organized streaming.
- **Real-Time Streaming**: Start and stop streams with just a few clicks, with live previews available.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- Ubuntu or any Debian-based Linux distribution.
- A web server with support for PHP and CodeIgniter 4.
- Access to a streaming service that supports RTMP.

## Installation

To install StreamDex, follow these steps:

1. **Update your package list and upgrade existing packages:**
   ```bash
   sudo apt update
   sudo apt upgrade -y
   ```

2. **Install Nginx:**
   ```bash
   sudo apt install nginx -y
   ```

3. **Install required PHP and FFmpeg packages:**
   ```bash
   sudo apt install software-properties-common
   sudo add-apt-repository ppa:ondrej/php
   sudo apt update
   sudo apt install curl ffmpeg git php8.1-fpm php8.1-sqlite3 php8.1-gd php8.1-intl php8.1-mbstring -y
   ```

4. **Start and enable PHP:**
   ```bash
   sudo systemctl start php8.1-fpm
   sudo systemctl enable php8.1-fpm
   ```

5. **Configure Nginx:**
   ```bash
   sudo nano /etc/nginx/sites-available/default
   ```

   Replace with the following configuration:
   ```nginx
   server {
       listen 80;
       server_name localhost;  # Change this to your domain or IP address

       root /var/www/html;  # Point to the root directory of your CodeIgniter project
       index index.php index.html index.htm;

       client_max_body_size 100M;
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location ~ \.php$ {
           include snippets/fastcgi-php.conf;
           fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;  # Update PHP version as needed
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
           include fastcgi_params;
       }

       location ~ /\.ht {
           deny all;
       }
   }
   ```

6. **Restart Nginx:**
   ```bash
   sudo systemctl restart nginx
   ```

7. **Clone the StreamDex repository:**
   ```bash
   sudo git clone https://github.com/Subhendu1987/StreamDex.git .
   ```

8. **Set writable permissions:**
   ```bash
   sudo chmod -R 777 /var/www/html/writable
   ```

9. **Install the RTMP module for Nginx:**
   ```bash
   sudo add-apt-repository universe
   sudo apt install libnginx-mod-rtmp
   ```

10. **Configure Nginx for RTMP streaming:**
    ```bash
    sudo chown www-data:www-data /etc/nginx/nginx.conf
    sudo chmod 664 /etc/nginx/nginx.conf
    ```

    Edit the Nginx configuration:
    ```bash
    sudo nano /etc/nginx/nginx.conf
    ```

    Replace with the following configuration:
    ```nginx
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

        ssl_protocols TLSv1 TLSv1.1 TLSv1.2 TLSv1.3; # Dropping SSLv3, ref: POODLE
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
                push rtmp://localhost/live; # Change this to your local RTMP address
            }
        }
    }
    ```

11. **Restart Nginx again:**
    ```bash
    sudo systemctl restart nginx
    ```

## Alternative Installation via Docker

For quick setup, you can use the official Docker image available on Docker Hub.

## Prerequisite: Install Docker (if not already installed)

1. **Prerequisite: Install Docker (if not already installed)**
   ```bash
   apt install docker.io -y
   ```

1. **Pull the Docker Image**
   ```bash
   docker pull dexcorp/streamdex
   ```

2. **Run the Docker Container**
   ```bash
   docker run -d -p 80:80 -p 1935:1935 --name streamdex-container dexcorp/streamdex
   ```

## License

StreamDex is licensed under the [GNU General Public License v2.0](https://opensource.org/licenses/GPL-2.0).

## Contribution

Contributions are welcome! Please feel free to submit a pull request or report issues on the [GitHub repository](https://github.com/Subhendu1987/StreamDex).
