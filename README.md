# Portfolio Manager

Личный backend-проект портфолио на Laravel + Apiato с публичной страницей, админ-панелью Filament и API/WEB-аутентификацией.

## Что реализовано сейчас

- Публичная WEB-страница (`/`) с hero/contacts/текущей разработкой.
- Данные публичной страницы подтягиваются из `Spatie Laravel Settings`:
  - `ProfileSettings`
  - `ContactSettings`
- Логика подготовки данных для welcome вынесена в Task:
  - `App\Containers\AppSection\Authentication\Tasks\BuildHomePageDataTask`
- Filament Admin Panel (`/admin`) с отдельными страницами управления настройками:
  - `ManageProfileSettings`
  - `ManageContactSettings`
- Контейнеры Apiato:
  - `Authentication` (WEB + API auth, Passport)
  - `Authorization` (roles/permissions)
- Подключены Telescope, Passport, Spatie MediaLibrary, Spatie Settings.

## Технологии

- PHP `^8.4`
- Laravel 12 + Apiato Core `^13.1`
- Filament `^5.0`
- Spatie Laravel Settings `^3.7`
- Laravel Passport `^13.0`
- MySQL
- Tailwind CSS + Vite

## Структура проекта (кратко)

- `app/Containers` — бизнес-модули Apiato (Actions/Tasks/Routes/Tests).
- `app/Ship` — общая инфраструктура проекта.
- `app/Filament` — ресурсы и страницы админ-панели.
- `app/Settings` — классы групп настроек (`ProfileSettings`, `ContactSettings`).
- `database/settings` — миграции значений Spatie Settings.
- `resources` — фронтенд-ассеты (CSS/JS).

## Локальный запуск

1. Установить зависимости PHP:

```bash
composer install
```

2. Установить frontend-зависимости:

```bash
npm install
```

3. Подготовить `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

4. Настроить подключение к MySQL в `.env`.

5. Выполнить миграции и сиды:

```bash
php artisan migrate --seed
```

6. Опубликовать ассеты Filament (если нужно после установки/обновления):

```bash
php artisan filament:assets
```

7. Создать пользователя для входа в админ-панель:

```bash
php artisan make:filament-user --panel=admin
```

8. Запустить приложение:

```bash
php artisan serve
npm run dev
```

## Основные URL

- Публичная страница: `http://localhost:8000/`
- Filament: `http://localhost:8000/admin`
- Telescope: `http://localhost:8000/telescope`

## Настройки публичной страницы

Публичный экран использует данные из `Spatie Laravel Settings`.

- `profile.*`:
  - `full_name`, `nickname`, `job_title`, `short_bio`, `full_bio`, `location`, `status`, `is_available_for_work`
- `contact.*`:
  - `email`, `phone`, `telegram`, `github_url`, `website_url`

Редактирование выполняется через Filament-страницы настроек.

## Полезные команды

```bash
# Тесты
php artisan test

# Статический анализ / quality tools (по необходимости)
composer fixer
composer ide-helper

# Сборка frontend
npm run build
```

## Примечания

- В проекте используются Apiato-миграции Passport из контейнера `Authentication`.
- Для `tailwind` учитываются Blade-файлы контейнеров (`./app/Containers/**/*.blade.php`).
- Если фронтенд-изменения не применились, проверьте `npm run dev` / `npm run build`.

## Автор

Alexander Bubnov  
Email: `alexunderbubnov@gmail.com`
