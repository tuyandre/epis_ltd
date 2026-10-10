# EPIS Ltd website (Laravel)

Public marketing site plus a small admin panel. Content (services, team, projects, clients) lives in the database. Quote requests are saved and emailed.

## Setup

1. Create an empty MySQL database named `epis_ltd` and set `DB_USERNAME` / `DB_PASSWORD` in `.env`.
2. Install and migrate:

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

3. Open http://127.0.0.1:8000. Admin is at `/admin`.

## Before going live

- Change `ADMIN_EMAIL` / `ADMIN_PASSWORD` in `.env` before seeding, or change the password afterwards.
- Set real `MAIL_*` values so quote emails reach `EPIS_CONTACT_EMAILS` (comma-separated) (default mailer is `log`).
- Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`.
- Contact details and service options: `config/epis.php`.
- Mission, vision, values, hero and about copy: `resources/views/partials/`.

## Tests

```bash
php artisan test
```

Tests use SQLite (`pdo_sqlite` must be enabled in php.ini).
