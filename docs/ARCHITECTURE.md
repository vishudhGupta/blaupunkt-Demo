# Multi-Country Multi-Language Architecture

## URL design

- Default site: `/`
- Localized site: `/{locale}`
- Locale format: `{country}-{language}`

Examples:

- `/eu-en/`
- `/ae-ar/`
- `/in-en/products`
- `/eu-fr/blogs/some-slug`

## Locale and market model

- Config source: `config/markets.php`
- Locale table: `locales`
- Supported locales validated by `SetLocaleFromRouteMiddleware`

## Geo-IP redirect strategy

Priority order in `GeoIpResolver`:

1. Cloudflare header `CF-IPCountry`
2. MaxMind local DB (`storage/app/geoip/GeoLite2-Country.mmdb`)

Root path `/` redirects only when a mapped locale exists.
Unsupported countries stay on default site.

## Content modules

- Products:
  - `products`
  - `product_translations`
  - `product_market_assignments`
- Blogs:
  - `blogs`
  - `blog_translations`
- CMS:
  - `pages`
  - `page_translations`
- SEO:
  - `seo_meta`

## SEO and sitemap

- Per-locale meta fields exist on translation tables and `seo_meta`.
- Hreflang links generated via `HreflangService`.
- Dynamic sitemap index at `/sitemap.xml`.
- Locale sitemap at `/sitemap-{locale}.xml`.

## Search

Localized search endpoint: `/{locale}/search?q=...`

- Product search uses translation table for current locale.
- Blog search uses translation table for current locale.

## Admin and security baseline

- Admin route prefix: `/admin`
- Role middleware: `EnsureUserRoleMiddleware`
- Audit middleware: `AuditLogMiddleware`
- 2FA columns are included in `users` table migration extension.

## API-ready routes

- `/api/{locale}/products`
- `/api/{locale}/blogs`
- `/api/{locale}/pages/{slug}`
