# Blaupunkt – Hostinger Shared Hosting Deployment Guide

## What you need
- FTP client (FileZilla is free)
- Your Hostinger DB credentials (from hPanel → Databases)

---

## STEP 1 – Generate APP_KEY (do this on your local PC first)

Run this once in your project folder:
```
php artisan key:generate --show
```
Copy the output (it looks like: `base64:xxxx...`). You'll put it in the .env file.

---

## STEP 2 – Prepare your .env file

1. Open `hostinger_deploy/.env.production`
2. Fill in:
   - `APP_URL` → your actual domain, e.g. `https://mysite.com`
   - `APP_KEY` → the key you generated in Step 1
   - `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` → from Hostinger hPanel → MySQL Databases
   - `DB_HOST` → usually `localhost` on Hostinger (check hPanel to confirm)
3. Save this file as `.env` (no extension)

---

## STEP 3 – Upload files via FTP

Connect to your Hostinger account via FTP. Then:

### A. Upload the whole Laravel project into `public_html/_laravel/`

Upload these folders/files into `public_html/_laravel/`:
```
app/
bootstrap/
config/
database/
resources/
routes/
storage/
vendor/
.env          ← the file you prepared in Step 2
artisan
composer.json
```

> **Skip:** `public/`, `node_modules/`, `tests/`, `.git/`, `hostinger_deploy/`

### B. Upload public assets to `public_html/` (root)

From this project's `public/` folder, upload to `public_html/` root:
```
favicon.ico
robots.txt
```

From `hostinger_deploy/` folder, upload to `public_html/` root:
```
index.php     ← replaces/creates public_html/index.php
.htaccess     ← replaces/creates public_html/.htaccess
setup.php     ← one-time setup script
```

### Final structure on server:
```
public_html/
  _laravel/          ← all Laravel app files
    app/
    bootstrap/
    config/
    database/
    resources/
    routes/
    storage/
    vendor/
    .env
    artisan
  index.php          ← from hostinger_deploy/
  .htaccess          ← from hostinger_deploy/
  setup.php          ← from hostinger_deploy/
  favicon.ico
  robots.txt
```

---

## STEP 4 – Set folder permissions

In Hostinger hPanel → File Manager, or via FTP, set these folders to **755**:
- `public_html/_laravel/storage/`
- `public_html/_laravel/bootstrap/cache/`

---

## STEP 5 – Edit setup.php (security!)

Before uploading `setup.php`, open it and change line 13:
```php
define('SETUP_SECRET', 'CHANGE_THIS_SECRET');
```
to something only you know, e.g.:
```php
define('SETUP_SECRET', 'MySecret2024xyz');
```

---

## STEP 6 – Run setup via browser

Visit: `https://yourdomain.com/setup.php?secret=MySecret2024xyz`

This will:
- Check your .env and DB connection
- Run all database migrations automatically
- Warm up caches

If you want to also seed initial data (locales, sample products):
Visit: `https://yourdomain.com/setup.php?secret=MySecret2024xyz&seed=1`

---

## STEP 7 – Delete setup.php!

After setup is done, **immediately delete** `public_html/setup.php` from your server.
It's a security risk to leave it there.

---

## Troubleshooting

| Problem | Fix |
|---------|-----|
| White page / 500 error | Check `public_html/_laravel/storage/logs/laravel.log` |
| DB connection error | Double-check DB credentials in `_laravel/.env` |
| 403 on all pages | Make sure `.htaccess` was uploaded correctly |
| "No application key" error | Make sure `APP_KEY=` is filled in `.env` |
| Images/CSS not loading | Check `APP_URL` in `.env` matches your actual domain |
| Session/cache errors | Make sure `storage/` subfolders exist and are writable (chmod 755) |
