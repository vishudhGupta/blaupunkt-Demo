# Multi-Country Multi-Language Laravel Platform

This repository implements a single-codebase, single-database architecture for multi-country and multi-language content delivery.

## Core capabilities

- Country + language URL model with locale validation middleware
- Geo-IP redirect from root path using Cloudflare country header and request IP with MaxMind
- Localized products, blogs, and CMS pages
- Market-based product visibility through assignment table
- Locale-specific search
- Locale-specific sitemap endpoints and hreflang generation
- API-ready locale endpoints
- Admin dashboard baseline with role gate and audit logging middleware

## URL strategy

- Default (unmapped countries): `/`
- Localized: `/{country-language}`

Examples:

- `/eu-en/`
- `/ae-ar/`
- `/cm-fr/about-us`
- `/eu-de/products/model-x`
- `/in-en/blogs/new-launch`

## Documentation

- [Architecture](docs/ARCHITECTURE.md)
- [Installation](docs/INSTALLATION.md)
- [Deployment](docs/DEPLOYMENT.md)
- [Filament and Spatie Integration Plan](docs/FILAMENT_AND_SPATIE_PLAN.md)

## Important environment note

This codebase targets modern package releases that require PHP 8.4+ for complete stack installation (Filament and current Spatie packages).

If your local machine uses an older PHP version, upgrade PHP before running full dependency install and Artisan lifecycle commands.
