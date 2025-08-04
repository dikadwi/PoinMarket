# Deployment Guide PoinMarket

## 1. Persyaratan Sistem

### 1.1 Server Requirements
- PHP 7.4+ dengan ekstensi:
  - intl
  - mbstring
  - json
  - mysql/mysqli
  - xml
  - curl
- MySQL 5.7+ atau MariaDB 10.2+
- Apache 2.4+ atau Nginx 1.16+
- Composer 2.0+
- Git

### 1.2 Server Specifications
Minimum requirements:
- CPU: 2 cores
- RAM: 4GB
- Storage: 20GB SSD
- Bandwidth: 2Mbps

Recommended:
- CPU: 4 cores
- RAM: 8GB
- Storage: 50GB SSD
- Bandwidth: 10Mbps

## 2. Persiapan Deployment

### 2.1 Setup Database
```sql
CREATE DATABASE poinmarket CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'poinmarket_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON poinmarket.* TO 'poinmarket_user'@'localhost';
FLUSH PRIVILEGES;
```

### 2.2 Web Server Configuration

#### Apache (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>

<IfModule mod_headers.c>
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
    Header set X-Content-Type-Options "nosniff"
</IfModule>
```

#### Nginx (nginx.conf)
```nginx
server {
    listen 80;
    server_name poinmarket.yourdomain.com;
    root /var/www/poinmarket/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

## 3. Langkah Deployment

### 3.1 Clone Repository
```bash
cd /var/www
git clone https://github.com/your-repo/poinmarket.git
cd poinmarket
```

### 3.2 Install Dependencies
```bash
composer install --no-dev
npm install
npm run production
```

### 3.3 Konfigurasi Environment
```bash
cp env .env
```

Edit file .env:
```env
# Database
database.default.hostname = localhost
database.default.database = poinmarket
database.default.username = poinmarket_user
database.default.password = your_secure_password

# App
app.baseURL = 'https://poinmarket.yourdomain.com'
app.indexPage = ''
app.forceGlobalSecureRequests = true

# Security
encryption.key = 'generate_random_32_char_key'
```

### 3.4 Setup Database & Storage
```bash
# Run migrations
php spark migrate

# Run seeders
php spark db:seed InitialSeeder

# Set permissions
chmod -R 755 writable/
chmod -R 755 public/uploads/
chown -R www-data:www-data .
```

### 3.5 Cache Configuration
```bash
# Clear cache
php spark cache:clear

# Generate route cache
php spark route:cache

# Generate autoloader optimization
composer dump-autoload -o
```

## 4. Post-Deployment

### 4.1 Security Checklist
- [ ] SSL/TLS certificate terpasang
- [ ] Firewall dikonfigurasi
- [ ] File permissions diset dengan benar
- [ ] Debug mode dimatikan
- [ ] Error reporting dimatikan
- [ ] Session security dikonfigurasi
- [ ] CSRF protection aktif

### 4.2 Performance Optimization
```bash
# Enable OPCache
sed -i 's/;opcache.enable=1/opcache.enable=1/' /etc/php/7.4/fpm/php.ini
sed -i 's/;opcache.memory_consumption=128/opcache.memory_consumption=256/' /etc/php/7.4/fpm/php.ini

# Configure PHP-FPM
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35

# Restart services
systemctl restart php7.4-fpm
systemctl restart nginx
```

### 4.3 Monitoring Setup
- Setup log rotation
- Configure error logging
- Setup monitoring tools (e.g., NewRelic, Datadog)
- Configure backup system

## 5. Backup Strategy

### 5.1 Database Backup
```bash
#!/bin/bash
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/backup/database"
mysqldump -u poinmarket_user -p poinmarket > "$BACKUP_DIR/poinmarket_$TIMESTAMP.sql"
```

### 5.2 File Backup
```bash
#!/bin/bash
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/backup/files"
tar -czf "$BACKUP_DIR/poinmarket_files_$TIMESTAMP.tar.gz" /var/www/poinmarket
```

## 6. Troubleshooting

### 6.1 Common Issues
1. 500 Internal Server Error
   - Check error logs
   - Verify file permissions
   - Validate .env configuration

2. Database Connection Issues
   - Verify credentials
   - Check MySQL service
   - Test connection manually

3. Upload Issues
   - Check directory permissions
   - Verify PHP upload limits
   - Check disk space

### 6.2 Log Locations
- Application: /var/www/poinmarket/writable/logs/
- PHP: /var/log/php7.4-fpm.log
- Nginx: /var/log/nginx/error.log
- MySQL: /var/log/mysql/error.log

## 7. Maintenance Mode
```bash
# Enable maintenance mode
php spark down

# Disable maintenance mode
php spark up
```
