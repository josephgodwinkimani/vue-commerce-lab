# VueCommerceLab

**Project Overview:** 🚀

This repository houses an experimental E-commerce store that serves as a practical application for learning and implementing Laravel. I scaffolded this [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia) and use [Laravel Valet](https://laravel.com/docs/10.x/valet#installation) for local development.

**Key Features:** 🛠

-   **CRUD Operations**: Comprehensive Create, Read, Update, and Delete functionalities for products and customers, showcasing Laravel's robust back-end capabilities.
-   **[Laravel 10](https://laravel.com/docs/10.x)**: A powerful PHP framework for building scalable web applications with a clean, expressive syntax.
-   **[Vue.js 3](https://vuejs.org/guide/introduction.html)**: A dynamic and reactive frontend built with Vue.js, offering an engaging user experience.
-   **[Ziggy](https://github.com/tighten/ziggy)**: Exposes Laravel's named server-side routes via a global `route()` function, allowing for easy route generation in Vue components.
-   **[Inertia.js](https://inertiajs.com/)**: Bridges Laravel and Vue.js, enabling server-side rendering and client-side navigation without page reloads.
-   **[TailwindCSS](https://tailwindcss.com/)**: A utility-first CSS framework used for designing sleek, responsive layouts with speed and efficiency.
-   **Tests** Unit tests for all models and controllers via `php artisan test`.
-   **Github Actions** Continuous integration and testing via Github Actions.

**Learning Outcomes:** 📚

-   Mastering Laravel's MVC architecture for building scalable web applications.
-   Implementing SPA behaviors in Laravel with Vue.js and Inertia.js.
-   Developing intuitive UIs with Tailwind CSS.
-   Understanding state management and reactivity in Vue.js.
-   Grasping the principles of RESTful API design and CRUD operations in Laravel.

**Project Sections:** 🔍

-   **Products**: Includes features like product listing, adding new products, editing, and deleting.
-   **Customers**: Manages customer data with functionalities for adding, viewing, editing, and removing customer records.
-   **Orders**: Allows users to place orders for products, with a dedicated page for viewing all orders.
-   **Reports**: Provides a dashboard for viewing sales reports and other metrics.

**Motivation:** 💡

This project is part of a learning journey to explore the depths of Laravel, Vue.js, and modern web development practices. It serves as a comprehensive example for anyone interested in developing full-featured web applications using these technologies.

---

## Installation

Log into MySQL:

```bash
mysql -u root -h 127.0.0.1
```

Create a database:

```sql
CREATE DATABASE vue_commerce_lab;
```

Clone the repository (into your Valet sites directory):

```bash
cd ~/Sites && git clone git@github.com:gregrickaby/vue-commerce-lab.git
```

Install dependencies:

```bash
cd vue-commerce-lab && composer install && npm install
```

Create `.env` file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Run a migration:

```bash
php artisan migrate:fresh
```

Seed the database:

```bash
php artisan db:seed
```

Secure the site:

```bash
valet secure
```

Start development server:

```bash
npm run dev
```

Visit the site: <https://vue-commerce-lab.test>

---

## Next Steps

Login with the following credentials:

-   user: <admin@vuecommercelab.com>
-   pass: `password`

---

## Vue.js

Vue.js files are located in the `resources/js` directory.

### Directory Structure

You'll mostly be working with both the `Components` and `Pages` directories.

```tree
├── resources
│   ├── js
│   │   ├── Components
│   │   │   ├── Atoms
│   │   │   ├── Molecules
│   │   │   ├── Organisms
│   │   │   ├── ...
│   │   ├── Layouts
│   │   │   ├── AuthenticatedLayout.vue
│   │   │   ├── GuestLayout.vue
│   │   ├── Pages
│   │   │   ├── Customers
│   │   │   │   ├── Create.vue
│   │   │   │   ├── Index.vue
│   │   │   │   └── {customer}
│   │   │   │       ├── Edit.vue
│   │   │   │       └── Show.vue
│   │   │   ├── ...
```

### Dynamic Routes

Folders with a `{}` around them are dynamic routes. For example, `/Pages/Customers/{customers}/Edit.vue` is a dynamic route that will match any customer ID. The ID is then available in the `Edit.vue` component.

---

## MVC

### Models

Models are located in the `app/Models` directory. Each model has a corresponding factory and seeder in the `database/factories` and `database/seeders` directories.

### Views

This application uses Vue and Inertia, so the views are in the `resources/js/pages` directory.

### Controllers

Controllers are located in the `app/Http/Controllers` directory. Each controller has a corresponding test in the `tests/Feature` directory

---

## Tests

This application is equipped with PHPUnit tests for all models and controllers. Run the tests with:

```bash
php artisan test
```

Run a specific test with:

```bash
php artisan test --filter=CustomerTest
```

Github Actions will also run the tests on every PR to the `main` branch.

---

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---
