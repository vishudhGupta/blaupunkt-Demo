# Installation Guide

## Prerequisites

- PHP 8.4+
- Composer 2.8+
- MySQL 8+

## 1) Clone and configure

```bash
cp .env.example .env
composer install
php artisan key:generate
```

Update `.env`:

- `APP_URL`
- MySQL credentials

Demo defaults already use:

- `CACHE_STORE=file`
- `SESSION_DRIVER=file`
- `QUEUE_CONNECTION=sync`

## 2) Database setup

```bash
php artisan migrate
php artisan db:seed
```

## 3) Install optional production packages

These packages are part of the target stack and should be installed on a PHP 8.4 runtime:

```bash
composer require filament/filament:^5.6
composer require spatie/laravel-sitemap:^8.1
composer require spatie/laravel-medialibrary:^12.0
composer require geoip2/geoip2:^3.3
```

## 4) Frontend build

No Node.js build is required for this demo setup.

## 5) Cache and queue

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 6) Verify routes

- `GET /`
- `GET /eu-en/`
- `GET /eu-en/products`
- `GET /eu-en/blogs`
- `GET /sitemap.xml`
- `GET /api/eu-en/products`

## 7) Roles

Current role values supported in code:

- `super-admin`
- `editor`
- `seo-manager`
- `content-manager`
