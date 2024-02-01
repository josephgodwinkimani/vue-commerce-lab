# VueCommerceLab

## Project Overview 🚀

This repository houses an experimental E-commerce dashboard that serves as a practical application for learning and implementing Laravel. I scaffolded this with [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia) and use [Laravel Valet](https://laravel.com/docs/10.x/valet#installation) for local development.

### Key Features 🛠

-   **CRUD Operations**: Comprehensive Create, Read, Update, and Delete functionalities for products and customers, showcasing Laravel's robust back-end capabilities.
-   **[Laravel 10](https://laravel.com/docs/10.x)**: A powerful PHP framework for building scalable web applications with a clean, expressive syntax.
-   **[TypeScript](https://www.typescriptlang.org/)**: A superset of JavaScript that adds static type definitions, enabling a more robust development experience.
-   **[Vue.js 3](https://vuejs.org/guide/introduction.html)**: A dynamic and reactive frontend built with Vue.js, offering an engaging user experience.
-   **[Ziggy](https://github.com/tighten/ziggy)**: Exposes Laravel's named server-side routes via a global `route()` function, allowing for easy route generation in Vue components.
-   **[Inertia.js](https://inertiajs.com/)**: Bridges Laravel and Vue.js, enabling server-side rendering and client-side navigation without page reloads.
-   **[TailwindCSS](https://tailwindcss.com/)**: A utility-first CSS framework used for designing sleek, responsive layouts with speed and efficiency.
-   **[Storybook](https://storybook.js.org/)**: A development environment for UI components, allowing for rapid iteration and testing.
-   **[Atomic Design](https://bradfrost.com/blog/post/atomic-web-design/):** A methodology for designing UIs with a focus on reusability and scalability.
-   **Tests:** Unit tests for all models and controllers using PHPUnit, and component tests for Vue.js components using Vitest and Vue Test Utils.
-   **Linting and Formatting:** Automatic linting and formatting for PHP, JavaScript, CSS and Vue.js files.
-   **Github Actions:** Continuous integration and testing with Github Actions.

### Learning Outcomes 📚

-   Mastering Laravel's MVC architecture for building scalable web applications.
-   Implementing SPA behaviors in Laravel with Vue.js and Inertia.js.
-   Developing intuitive UIs with Tailwind CSS.
-   Understanding state management and reactivity in Vue.js.
-   Grasping the principles of RESTful API design and CRUD operations in Laravel.
-   Writing unit tests for models and controllers with PHPUnit and Vitest.

### Project Sections 🔍

-   **Products**: Includes features like product listing, adding new products, editing, and deleting.
-   **Customers**: Manages customer data with functionalities for adding, viewing, editing, and removing customer records.
-   **Orders**: Allows users to place orders for products, with a dedicated page for viewing all orders.
-   **Reports**: Provides a dashboard for viewing sales reports and other metrics.

### Motivation 💡

This project serves as a comprehensive example for anyone interested in developing full-featured web applications using these technologies.

---

## Installation

Clone the repository (into your Valet sites directory):

```bash
git clone git@github.com:gregrickaby/vue-commerce-lab.git
```

Install dependencies:

```bash
composer install && npm install
```

Create `.env` file:

```bash
cp .env.example .env
```

Create `database.sqlite` file:

```bash
touch database/database.sqlite
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

Set the PHP version to 8.3:

```bash
valet isolate php@8.3
```

Secure the site:

```bash
valet secure
```

Start development server:

```bash
npm run dev
```

Visit the site: <https://vue-commerce-lab.test> and login with the following credentials:

-   user: <admin@vuecommercelab.com>
-   pass: `password`

---

## Laravel

### Models

Models are located in the `app/Models` directory. Each model has a corresponding factory and seeder in the `database/factories` and `database/seeders` directories.

Models are responsible for managing the data of the application. They receive input from the controller, validate it, then send it to the database.

### Views

This application uses Vue and Inertia, so the views are in the `resources/js/pages` directory and routed via the [web.php](https://github.com/gregrickaby/vue-commerce-lab/blob/main/routes/web.php) file.

Views are responsible for displaying the data to the user. They receive data from the controller, then render it to the browser.

### Controllers

Controllers are located in the `app/Http/Controllers` directory. Each controller has a corresponding test in the `tests/Feature` directory

Controllers are responsible for handling requests and returning responses. They receive input from the user, validate it, then pass it to the model.

### Routes

Routes are located in the `routes` directory. The `web.php` file contains all the routes for the application.

---

## Vue.js

Vue.js files are located in the `resources/js` directory.

### Directory Structure

The directory structure follows standard Laravel conventions, with the addition of a `types` directory for TypeScript interfaces and types, and a `utils` directory for utility and helper functions.

```tree
├── resources
│   ├── css
│   │   └── app.css <-- TailwindCSS
│   ├── js
│   │   ├── Components
│   │   │   ├── Atoms
│   │   │   │   ├── ApplicationLogo
│   │   │   │   │   ├── ApplicationLogo.stories.ts <-- Storybook
│   │   │   │   │   ├── ApplicationLogo.test.ts <-- Test
│   │   │   │   │   ├── ApplicationLogo.test.ts.snap <-- Snapshot
│   │   │   │   │   └── ApplicationLogo.vue <-- Vue Component
│   │   │   ├── Molecules
│   │   │   ├── Organisms
│   │   ├── Layouts
│   │   ├── Pages
│   │   │   ├── Customers
│   │   │   │   ├── Create.vue
│   │   │   │   ├── Index.vue
│   │   │   │   └── {customer} <-- Dynamic route
│   │   │   │       ├── Edit.vue
│   │   │   │       └── Show.vue
│   │   ├── app.ts <-- Vue app
│   │   ├── types
│   │   │   └── index.d.ts <-- Typescript interfaces and types
│   │   └── utils
│   │       └── index.ts <-- Utility and helper functions
│   └── views
│       ├── app.blade.php
│       └── welcome.blade.php
```

### Dynamic Routes

Folders with a `{}` around them are dynamic routes. For example, `/Pages/Customers/{customers}/Edit.vue` is a dynamic route that will match any customer ID. The ID is then available in the `Edit.vue` component.

---

## Tests

This application is equipped with both PHPUnit and Vitest for testing. It also leverages Github Actions for continuous integration and testing, and Storybook for developing UI components in isolation.

### PHPUnit

This application is equipped with PHPUnit tests for all models and controllers. PHP tests are located in the `/tests` directory:

```tree
├── tests
│   ├── Feature
│   │   ├── Auth
│   │   │   ├── AuthenticationTest.php
│   │   └── ExampleTest.php
│   └── Unit
│       └── ExampleTest.php
```

Laravel routes return Inertia responses that depend on the presence of Vue components. Without the built front-end assets, these components won't be available, leading to failures in tests that make requests to these routes. To avoid this, **you must run the development server in the background while running tests**.

Start the development server:

```bash
npm run dev
```

Run PHPUnit tests with:

```bash
php artisan test
```

Run a specific test with:

```bash
php artisan test --filter=CustomerTest
```

### Vue Component Testing

This application is equipped with both [Vitest](https://vitest.dev/) (official test runner) and [Vue Test Utils](https://test-utils.vuejs.org/guide/) (official testing library) for testing Vue components. Tests must be placed next to the component and named `ComponentName.test.ts`:

```tree
├── resources
│   ├── js
│   │   ├── Components
│   │   │   ├── Atoms
│   │   │   │   ├── ApplicationLogo
│   │   │   │   │   ├── ApplicationLogo.stories.ts <-- Storybook
│   │   │   │   │   ├── ApplicationLogo.test.ts <-- Test
│   │   │   │   │   ├── ApplicationLogo.test.ts.snap <-- Snapshot
│   │   │   │   │   └── ApplicationLogo.vue <-- Vue Component
```

You can run the tests with:

```bash
npm run test
```

Vitest will run the tests in watch mode, so you can make changes to the component and see the results in real-time.

#### Writing Component Tests

Component tests are written in TypeScript and use the [Vitest API](https://vitest.dev/api/) for assertions. Here's an example:

```ts
import ApplicationLogo from '@/Components/Atoms/ApplicationLogo/ApplicationLogo.vue'
import { mount } from '@vue/test-utils'
import { describe, expect, test } from 'vitest'

/**
 * Define a test suite.
 *
 * @see https://vitest.dev/api/#describe
 */
describe('ApplicationLogo', () => {
    /**
     * Mount the component.
     *
     * @see https://vue-test-utils.vuejs.org/api/#mount
     */
    const wrapper = mount(ApplicationLogo)

    /**
     * Assert the component renders.
     *
     * @see https://vitest.dev/api/expect.html
     */
    test('component renders', () => {
        expect(wrapper).toBeTruthy()
    })

    /**
     * Assert the component is a SVG.
     */
    test('component is SVG', () => {
        wrapper.find('svg')
    })

    /**
     * Assert the component matches the snapshot.
     *
     * @see https://vitest.dev/api/expect.html#tomatchsnapshot
     */
    test('component matches snapshot', () => {
        expect(wrapper.html()).toMatchSnapshot()
    })
})
```

#### Helpful Links

1. [Vitest API](https://vitest.dev/api/)
2. [Vue Test Utils API](https://test-utils.vuejs.org/api/)

### Github Actions

Github Actions will also [run the tests](https://github.com/gregrickaby/vue-commerce-lab/actions) on every PR to the `main` branch.

---

## Linting

### ESLint

This application is equipped with [ESLint](https://eslint.org/) and configured for parsing TypeScript. Automatic linting JavaScript and Vue files happens `on_save`.

You can also run lint manually:

```bash
npm run lint
```

### Stylelint and TailwindCSS (Prettier)

This application is equipped with [Stylelint](https://stylelint.io/) and the [Prettier plugin for TailwindCSS](https://github.com/tailwindlabs/prettier-plugin-tailwindcss). Automatic linting and formatting happens `on_save`.

### Prettier and Pint

Automatic formatting for both JavaScript and PHP files is configured for `on_save`. Please see the VSCode settings and extension [configs](https://github.com/gregrickaby/vue-commerce-lab/tree/main/.vscode) for more information.

Manually run Prettier and Pint with:

```bash
npm run format && composer run lint
```

---

## Storybook

> View Storybook: <https://gregrickaby.github.io/vue-commerce-lab/> 👀

This application is equipped with [Storybook](https://storybook.js.org/) for developing UI components in isolation. Stories must be written in [CSF](https://storybook.js.org/docs/api/csf), placed next to the component in the `resources/js/Components` directory. Stories must be named `ComponentName.stories.ts`:

```tree
├── resources
│   ├── js
│   │   ├── Components
│   │   │   ├── Atoms
│   │   │   │   ├── ApplicationLogo
│   │   │   │   │   ├── ApplicationLogo.stories.ts <-- Storybook
│   │   │   │   │   ├── ApplicationLogo.test.ts <-- Test
│   │   │   │   │   ├── ApplicationLogo.test.ts.snap <-- Snapshot
│   │   │   │   │   └── ApplicationLogo.vue <-- Vue Component
```

Run Storybook with:

```bash
npm run storybook
```

Build Storybook with:

```bash
npm run build:storybook
```

---

## License

The MIT License (MIT). Please see [LICENSE](LICENSE)

---
