# Filament and Spatie Integration Plan

This repository is prepared for the integration but package installation must happen on PHP 8.4+.

## Planned Filament modules

- Dashboard
- Product management with market assignment
- Blog management with locale assignment
- Page/CMS management
- SEO manager
- User and role management

## Planned Media Library usage

Collections:

- `product-images`
- `product-brochures`
- `blog-images`
- `warranty-documents`

## Planned Sitemap package usage

Use `spatie/laravel-sitemap` for scheduled static generation with per-locale sitemap files.

## Install commands (PHP 8.4+)

```bash
composer require filament/filament:^5.6
composer require spatie/laravel-medialibrary:^12.0
composer require spatie/laravel-sitemap:^8.1
composer require geoip2/geoip2:^3.3
```

After installation, generate Filament panel/resources and migrate.
