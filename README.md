# Laravel with Vue and Inertia

This is a project to learn Laravel with Vue and Inertia. It creates a dashboard for adding products to a demo e-commerce store. This project was created with [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia).

---

## Installation

1. Clone the repository

```bash
git clone git@github.com:gregrickaby/laravel-vue-inertia-example.git
```

2. Install dependencies

```bash
composer install && npm install
```

3. Create MySQL database

Using your favorite MySQL client, create a database for this project. I personally use [DBngin](https://github.com/TablePlus/DBngin) for managing my local MySQL databases.

-   Database Name: `laravel`
-   Database User: `root`
-   Database Password: {blank}

4. Create `.env` file

```bash
cp .env.example .env
```

5. Generate application key

```bash
php artisan key:generate
```

6. Run a migration

```bash
php artisan migrate:fresh
```

7. Seed the Database

```bash
php artisan db:seed
```

8. Start the development environment

I use <https://herd.laravel.com/> for running local Laravel projects. In the Herd GUI, point at the cloned repo.

9. Start the development server

```bash
npm run dev
```

---

## Next Steps

Visit the Dashboard and login with the following credentials:

-   user: <test@example.com>
-   pass: password

You can now start adding products!

---
