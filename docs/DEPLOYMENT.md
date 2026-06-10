# Deployment Guide (Ubuntu 24 + Nginx)

## 1) System packages

```bash
sudo apt update
sudo apt install -y nginx mysql-server php8.4 php8.4-fpm php8.4-mysql php8.4-xml php8.4-mbstring php8.4-curl php8.4-zip php8.4-gd php8.4-bcmath unzip
```

## 2) App deployment

```bash
git clone <repo> /var/www/blaupunkt
cd /var/www/blaupunkt
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
```

## 3) Performance optimization

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## 4) Queue and scheduler

For demo mode with `QUEUE_CONNECTION=sync`, only scheduler cron is needed:

```bash
* * * * * cd /var/www/blaupunkt && php artisan schedule:run >> /dev/null 2>&1
```

## 5) Nginx essentials

- Force HTTPS
- Enable HTTP/2
- Pass `CF-IPCountry` and real client IP from Cloudflare
- Route all requests to `public/index.php`

## 6) Security checklist

- Disable `APP_DEBUG`
- Enable Cloudflare WAF
- Rotate admin passwords
- Enforce 2FA for admin users
- Enable daily DB and media backups
- Enable log shipping and alerting
