# Portgolio-manager

Личный backend-проект для демонстрации моих инженерных навыков.

## Стек

- PHP 8.4
- Laravel + Apiato
- Filament Admin Panel (`/admin`)
- MySQL

## Статус проекта

Только базовая настройка проекта. Бизнес-функционал пока не реализован.

## Быстрый старт

1. Установить зависимости:

```bash
composer install
```

2. Создать файл окружения:

```bash
cp .env.example .env
```

3. Сгенерировать ключ приложения:

```bash
php artisan key:generate
```

4. Настроить базу данных в `.env` и выполнить миграции:

```bash
php artisan migrate
```

5. Опубликовать ассеты Filament:

```bash
php artisan filament:assets
```

6. Создать администратора:

```bash
php artisan make:filament-user --panel=admin
```

7. Запустить локальный сервер:

```bash
php artisan serve
```

URL админ-панели: `http://localhost:8000/admin`

## Рекомендуемые настройки `.env` для локальной разработки

Если еще не настроены DB-сессии/кэш:

```env
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

## Автор

Alexander Bubnov
