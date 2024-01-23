# VueCommerceLab

**Project Overview:** 🚀

This repository houses an experimental E-commerce store that serves as a practical application for learning and implementing **[Laravel](https://laravel.com/docs/10.x)**. I scaffolded this [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia) and use [Laravel Valet](https://laravel.com/docs/10.x/valet#installation) for local development.

VueCommerceLab is enriched with a modern tech stack, utilizing **[Vue.js](https://vuejs.org/guide/introduction.html)** and **[Inertia.js](https://inertiajs.com/)** for seamless single-page application experiences. **[TailwindCSS](https://tailwindcss.com/)** provides the styling, ensuring a responsive and visually appealing interface.

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

-   user: <test@example.com>
-   pass: `password`

---
