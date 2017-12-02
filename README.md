Pitt INFSCI 2701 Project Backend
===

Using PHP Laravel framework.

## How to start

1. Create a environment file

```bash
cp .env.example .env
php PittMoments/artisan key:generate
```

2. Set up a DB file and migrate it.

```bash
touch PittMoments/database/database.sqlite
php PittMoments/artisan migrate
```

3. Start PHP build-in webserver

```bash
php artisan serve
```

4. Open browser and everything is done.
