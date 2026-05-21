# ROLCC Cambodia — Deployment Guide

## System Requirements

| Requirement | Version |
|-------------|---------|
| PHP | 8.2+ |
| MySQL | 8.0+ |
| Node.js | 18+ |
| Composer | 2.x |
| Nginx / Apache | Latest |
| Redis | 6+ (recommended) |

---

## 1. Server Setup (Ubuntu 22.04 LTS)

### Install PHP 8.2
```bash
sudo apt update && sudo apt upgrade -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt install php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl \
  php8.2-gd php8.2-mbstring php8.2-zip php8.2-bcmath php8.2-intl \
  php8.2-imagick php8.2-redis -y
```

### Install MySQL 8.0
```bash
sudo apt install mysql-server -y
sudo mysql_secure_installation
mysql -u root -p
CREATE DATABASE rolcc_cambodia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'rolcc_user'@'localhost' IDENTIFIED BY 'YOUR_STRONG_PASSWORD';
GRANT ALL PRIVILEGES ON rolcc_cambodia.* TO 'rolcc_user'@'localhost';
FLUSH PRIVILEGES;
```

### Install Redis
```bash
sudo apt install redis-server -y
sudo systemctl enable redis-server
```

### Install Node.js 18
```bash
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs -y
```

### Install Composer
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

---

## 2. Project Setup

```bash
# Clone or upload the project
cd /var/www
sudo git clone <your-repo-url> rolcc-website
cd rolcc-website

# Set permissions
sudo chown -R www-data:www-data /var/www/rolcc-website
sudo chmod -R 755 /var/www/rolcc-website
sudo chmod -R 775 /var/www/rolcc-website/storage
sudo chmod -R 775 /var/www/rolcc-website/bootstrap/cache

# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node dependencies and build assets
npm install
npm run build

# Copy and configure environment
cp .env.example .env
nano .env  # Edit with your production values

# Generate application key
php artisan key:generate

# Create storage symlink
php artisan storage:link
```

---

## 3. Environment Configuration (.env)

```env
APP_NAME="ROLCC Cambodia"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://rolcccambodia.org

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=rolcc_cambodia
DB_USERNAME=rolcc_user
DB_PASSWORD=YOUR_STRONG_PASSWORD

CACHE_STORE=redis
SESSION_DRIVER=database
QUEUE_CONNECTION=database

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@rolcccambodia.org
```

---

## 4. Database Migration & Seeding

```bash
# Run migrations
php artisan migrate --force

# Seed demo data (development) or production data
php artisan db:seed --force

# For production: seed only required settings
php artisan db:seed --class=RolePermissionSeeder --force
php artisan db:seed --class=UserSeeder --force
php artisan db:seed --class=SettingSeeder --force
php artisan db:seed --class=SermonCategorySeeder --force
php artisan db:seed --class=MinistrySeeder --force
php artisan db:seed --class=DonationCategorySeeder --force
```

---

## 5. Nginx Configuration

```nginx
server {
    listen 80;
    server_name rolcccambodia.org www.rolcccambodia.org;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name rolcccambodia.org www.rolcccambodia.org;

    root /var/www/rolcc-website/public;
    index index.php index.html;

    # SSL Configuration
    ssl_certificate /etc/letsencrypt/live/rolcccambodia.org/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/rolcccambodia.org/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;

    # File size limit for uploads
    client_max_body_size 50M;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_read_timeout 300;
    }

    # Cache static assets
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }

    location ~ /\. {
        deny all;
    }

    # Deny access to sensitive files
    location ~* \.(env|log|sql)$ {
        deny all;
    }
}
```

---

## 6. Queue Workers

### Setup Supervisor
```bash
sudo apt install supervisor -y

# Create worker config
sudo nano /etc/supervisor/conf.d/rolcc-worker.conf
```

```ini
[program:rolcc-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/rolcc-website/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/log/supervisor/rolcc-worker.log
stopwaitsecs=3600

[program:rolcc-scheduler]
process_name=%(program_name)s
command=/bin/bash -c "while true; do php /var/www/rolcc-website/artisan schedule:run >> /dev/null 2>&1; sleep 60; done"
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/log/supervisor/rolcc-scheduler.log
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start rolcc-worker:*
```

---

## 7. SSL Certificate (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d rolcccambodia.org -d www.rolcccambodia.org
sudo systemctl enable certbot.timer
```

---

## 8. Production Optimization

```bash
# Cache configuration files
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Optimize autoloader
composer dump-autoload --optimize --no-dev

# Generate icons/PWA manifest
php artisan icons:cache

# Set optimal permissions
sudo find /var/www/rolcc-website -type f -exec chmod 644 {} \;
sudo find /var/www/rolcc-website -type d -exec chmod 755 {} \;
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data /var/www/rolcc-website
```

---

## 9. Regular Maintenance

```bash
# Clear all caches (when updating)
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check queue health
php artisan queue:monitor

# View logs
tail -f storage/logs/laravel.log

# Database backup (add to cron)
mysqldump -u rolcc_user -p rolcc_cambodia | gzip > /backups/rolcc_$(date +%Y%m%d).sql.gz
```

---

## 10. Default Admin Credentials

After running seeders, you can login with:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | superadmin@rolcccambodia.org | ROLCC@2024! |
| Admin | admin@rolcccambodia.org | Admin@2024! |
| Pastor | pastor@rolcccambodia.org | Pastor@2024! |

**⚠️ IMPORTANT: Change all passwords immediately after first login!**

---

## 11. Deployment Script (Zero-Downtime)

```bash
#!/bin/bash
# deploy.sh

echo "🚀 Deploying ROLCC Cambodia..."

cd /var/www/rolcc-website

# Pull latest code
git pull origin main

# Install/update dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Cache clear & rebuild
php artisan down --render="errors.503"
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan queue:restart
php artisan up

echo "✅ Deployment complete!"
```

---

## 12. Environment Variables Checklist

- [ ] `APP_KEY` — Generated (php artisan key:generate)
- [ ] `DB_PASSWORD` — Strong password set
- [ ] `MAIL_*` — SMTP configured
- [ ] `GOOGLE_ANALYTICS_ID` — Set for analytics
- [ ] `RECAPTCHA_*` — Set for form protection
- [ ] `PUSHER_*` — Set for live features
- [ ] `AWS_*` — Set if using S3 for media storage
- [ ] `REDIS_*` — Set for caching/queues

---

## Support

For technical support, contact the ROLCC Cambodia development team.

**Church Website:** rolcccambodia.org  
**Admin Panel:** rolcccambodia.org/admin
