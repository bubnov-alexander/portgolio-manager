# Portgolio-manager

Personal backend project for demonstrating my engineering skills.

## Stack

- PHP 8.4
- Laravel + Apiato
- Filament Admin Panel (`/admin`)
- MySQL

## Project Status

Base project setup only. Business features are intentionally not implemented yet.

## Quick Start

1. Install dependencies:

```bash
composer install
```

2. Create environment file:

```bash
cp .env.example .env
```

3. Generate app key:

```bash
php artisan key:generate
```

4. Configure database in `.env` and run migrations:

```bash
php artisan migrate
```

5. Publish Filament assets:

```bash
php artisan filament:assets
```

6. Create admin user:

```bash
php artisan make:filament-user --panel=admin
```

7. Run local server:

```bash
php artisan serve
```

Admin panel URL: `http://localhost:8000/admin`

## Local .env recommendation

For local development (if DB cache/session is not configured yet):

```env
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

## Author

Alexander Bubnov
