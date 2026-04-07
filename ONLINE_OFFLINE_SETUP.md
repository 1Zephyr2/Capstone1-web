# Online and Offline Runtime Setup (PAWSER)

This guide provides a stable workflow for both local offline demos and online deployments.

## Runtime Profiles

- Offline profile: SQLite + file sessions + file cache + sync queue
- Online profile: MySQL + file sessions + file cache + sync queue

Both profiles avoid requiring Redis or a separate queue worker.

## 1) One-time Dependencies

```bash
composer install
npm install
```

## 2) Offline Mode (No Internet Required)

```bash
composer run env:offline
php artisan key:generate --force
php artisan migrate --force
php artisan db:seed --force
npm run build
php artisan serve
```

App URL: http://localhost:8000

## 3) Online / Hosted Mode

1. Open `.env` and update DB and URL values after running `composer run env:online`.
2. Set these minimum values for your host:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.example
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pawser_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

3. Then run:

```bash
composer run runtime:online
npm run build
```

## 4) Validate Current Profile

Run this command any time after switching profiles:

```bash
composer run runtime:check
```

The check does all of the following:
- Confirms `.env` exists
- Ensures required `storage/framework/*` directories exist
- Runs `php artisan about`
- Runs `php artisan migrate:status`
- Runs `npm run build`

## 5) SQLite Corruption Recovery (Offline)

If you see `database disk image is malformed`:

1. Back up the broken file:

```bash
copy database\\database.sqlite database\\database.sqlite.corrupt-backup
```

2. Recreate DB and seed:

```bash
del database\\database.sqlite
type nul > database\\database.sqlite
php artisan optimize:clear
php artisan migrate --force
php artisan db:seed --force
```

## Notes

- `runtime:online` copies `.env.online.example` into `.env`. Update DB credentials immediately after.
- `runtime:offline` copies `.env.offline.example` into `.env` and seeds demo data.
- If your host supports queue workers and Redis, you can move from `sync/file` drivers later.
