# VueCommerceLab

**Project Overview:** 🚀

This repository houses an experimental E-commerce store that serves as a practical application for learning and implementing **[Laravel](https://laravel.com/docs/10.x)**.

The project is enriched with a modern tech stack, utilizing **[Vue.js](https://vuejs.org/guide/introduction.html)** and **[Inertia.js](https://inertiajs.com/)** for seamless single-page application experiences. **[TailwindCSS](https://tailwindcss.com/)** provides the styling, ensuring a responsive and visually appealing interface.

**Key Features:** 🛠

-   **CRUD Operations**: Comprehensive Create, Read, Update, and Delete functionalities for products and customers, showcasing Laravel's robust back-end capabilities.
-   **Vue.js Integration**: A dynamic and reactive frontend built with Vue.js, offering an engaging user experience.
-   **Inertia.js**: Bridges Laravel and Vue.js, enabling server-side rendering and client-side navigation without page reloads.
-   **TailwindCSS**: A utility-first CSS framework used for designing sleek, responsive layouts with speed and efficiency.

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

This project was scaffolded with [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia).

---

## Installation

1. Clone the repository

```bash
git clone git@github.com:gregrickaby/vue-commerce-lab.git
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
