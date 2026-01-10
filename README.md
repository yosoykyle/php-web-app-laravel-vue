# TaskMaster - Laravel + Vue 3 Integration

A modern task management application built with Laravel backend and Vue 3 frontend, showcasing a clean integration between the two frameworks using Vite.

## Features

-   **Task Management**: Create, complete, and delete tasks
-   **Real-time Statistics**: Track total, completed, and pending tasks
-   **Filter System**: View all tasks, active tasks, or completed tasks
-   **Modern UI**: Beautiful interface built with Tailwind CSS
-   **Responsive Design**: Works seamlessly on desktop and mobile devices
-   **API-First**: RESTful API backend with Vue frontend
-   **LocalStorage Fallback**: Tasks persist even when API is unavailable

## Tech Stack

-   **Backend**: Laravel 8.x
-   **Frontend**: Vue 3 (Composition API)
-   **Build Tool**: Vite
-   **Styling**: Tailwind CSS
-   **HTTP Client**: Axios

## Project Structure

```
laravel-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── TaskController.php      # API endpoints for tasks
│   └── Models/
│       └── Task.php                    # Task model
├── database/
│   └── migrations/
│       └── 2026_01_10_000000_create_tasks_table.php
├── resources/
│   ├── css/
│   │   └── app.css                     # Tailwind CSS imports
│   ├── js/
│   │   ├── app.js                      # Vue app initialization
│   │   ├── bootstrap.js                # Axios configuration
│   │   ├── App.vue                     # Main Vue component
│   │   └── components/
│   │       ├── StatCard.vue            # Statistics card component
│   │       └── TaskItem.vue            # Individual task component
│   └── views/
│       └── welcome.blade.php           # Main HTML template
├── routes/
│   ├── web.php                         # Web routes
│   └── api.php                         # API routes
├── vite.config.js                      # Vite configuration
├── tailwind.config.js                  # Tailwind configuration
└── package.json                        # NPM dependencies
```

## Prerequisites

Before you begin, ensure you have the following installed:

-   PHP >= 7.3
-   Composer
-   Node.js >= 16.x
-   NPM or Yarn
-   MySQL or SQLite

## Installation & Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd laravel-app
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_vue_app
DB_USERNAME=root
DB_PASSWORD=your_password
```

For quick setup, you can use SQLite instead:

```env
DB_CONNECTION=sqlite
# Comment out or remove other DB_* variables
```

If using SQLite, create the database file:

```bash
touch database/database.sqlite
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 6a. Laravel 8 Vite Integration Fix (Required for Laravel 8.x)

> **Note**: Laravel 8 does not natively support the `@vite` directive. If you see the literal text `@vite(['resources/css/app.css', 'resources/js/app.js'])` in your browser, follow these steps.

Add the following to `app/Providers/AppServiceProvider.php` in the `boot()` method:

```php
public function boot()
{
    \Illuminate\Support\Facades\Blade::directive('vite', function ($expression) {
        return "<?php
            \$files = $expression;
            \$publicPath = public_path();
            \$hotFile = \$publicPath . '/hot';

            if (file_exists(\$hotFile)) {
                \$url = file_get_contents(\$hotFile);
                \$url = trim(\$url);
                \$html = \"<script type='module' src='{\$url}/@vite/client'></script>\";
                foreach (\$files as \$file) {
                    \$html .= \"<script type='module' src='{\$url}/{\$file}'></script>\";
                }
                echo \$html;
            } else {
                \$manifestPath = \$publicPath . '/build/manifest.json';
                if (file_exists(\$manifestPath)) {
                    \$manifest = json_decode(file_get_contents(\$manifestPath), true);
                    foreach (\$files as \$file) {
                        if (isset(\$manifest[\$file])) {
                            \$chunk = \$manifest[\$file];
                            echo \"<script type='module' src='/build/{\$chunk['file']}'></script>\";
                            if (isset(\$chunk['css'])) {
                                foreach (\$chunk['css'] as \$css) {
                                    echo \"<link rel='stylesheet' href='/build/{\$css}'>\";
                                }
                            }
                        }
                    }
                }
            }
        ?>";
    });
}
```

After adding this code, clear the view cache:

```bash
php artisan view:clear
```

### 7. Build Frontend Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 8. Start the Development Server

Open a new terminal and run:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## How Vue Was Integrated with Laravel

This project demonstrates a clean, modern integration of Vue 3 with Laravel using Vite as the build tool. Here's how it was done:

### 1. Package Configuration

**package.json** includes:

-   `vue` (^3.4.0) - Vue 3 framework
-   `@vitejs/plugin-vue` (^5.0.0) - Vite plugin for Vue
-   `laravel-vite-plugin` (^1.0.0) - Laravel integration for Vite
-   `vite` (^5.0.0) - Next-generation frontend tooling
-   `tailwindcss` (^3.4.0) - Utility-first CSS framework
-   `axios` (^1.6.0) - HTTP client for API calls

### 2. Vite Configuration

**vite.config.js** is configured to:

-   Use the Laravel Vite plugin to process `resources/css/app.css` and `resources/js/app.js`
-   Use the Vue plugin with proper asset URL transformation
-   Enable hot module replacement for fast development

```javascript
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
```

### 3. Vue Application Setup

**resources/js/app.js** initializes the Vue application:

```javascript
import { createApp } from "vue";
import App from "./App.vue";

const app = createApp(App);
app.mount("#app");
```

### 4. Blade Template Integration

**resources/views/welcome.blade.php** includes:

-   The `@vite` directive to load compiled assets
-   A mounting point (`<div id="app"></div>`) for Vue

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>TaskMaster - Laravel + Vue</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>
```

### 5. Component Structure

Vue components are organized in `resources/js/components/`:

-   **App.vue**: Main application component with state management
-   **StatCard.vue**: Reusable component for displaying statistics
-   **TaskItem.vue**: Component for rendering individual tasks

### 6. API Integration

The Vue frontend communicates with Laravel backend through:

-   **API Routes** (`routes/api.php`): RESTful endpoints for tasks
-   **Controller** (`TaskController.php`): Handles CRUD operations
-   **Model** (`Task.php`): Eloquent model for database interactions
-   **Axios** (`resources/js/bootstrap.js`): Configured for API requests

### 7. Styling with Tailwind CSS

**tailwind.config.js** is configured to scan:

-   Blade templates (`resources/views/**/*.blade.php`)
-   Vue components (`resources/js/**/*.vue`)

This ensures all utility classes used in both Laravel and Vue are included in the final CSS bundle.

## API Endpoints

The application provides the following API endpoints:

| Method | Endpoint          | Description        |
| ------ | ----------------- | ------------------ |
| GET    | `/api/tasks`      | Retrieve all tasks |
| POST   | `/api/tasks`      | Create a new task  |
| PUT    | `/api/tasks/{id}` | Update a task      |
| DELETE | `/api/tasks/{id}` | Delete a task      |

### Example API Requests

**Create a task:**

```powershell
curl.exe -X POST http://localhost:8000/api/tasks `
  -H "Content-Type: application/json" `
  -d '{\"text\": \"My new task\", \"completed\": false}'
```

**Get all tasks:**

```powershell
curl.exe http://localhost:8000/api/tasks
```

**Update a task:**

```powershell
curl.exe -X PUT http://localhost:8000/api/tasks/1 `
  -H "Content-Type: application/json" `
  -d '{\"completed\": true}'
```

**Delete a task:**

```powershell
curl.exe -X DELETE http://localhost:8000/api/tasks/1
```

## Development Workflow

### Frontend Development

1. Start the Vite dev server for hot module replacement:

```bash
npm run dev
```

2. In another terminal, start the Laravel development server:

```bash
php artisan serve
```

3. Make changes to Vue components in `resources/js/` - they will hot reload automatically

### Backend Development

1. Modify controllers, models, or routes in the `app/` and `routes/` directories
2. The Laravel dev server will automatically pick up changes

### Database Changes

1. Create a new migration:

```bash
php artisan make:migration create_table_name
```

2. Run migrations:

```bash
php artisan migrate
```

3. Rollback if needed:

```bash
php artisan migrate:rollback
```

## Key Integration Points

### 1. Asset Loading

-   Laravel's `@vite` directive loads compiled CSS and JavaScript
-   Vite handles hot module replacement during development
-   Production builds are optimized and fingerprinted

### 2. API Communication

-   Vue components use Axios to communicate with Laravel API
-   CSRF protection is handled automatically via Axios headers
-   API routes are prefixed with `/api` for clear separation

### 3. State Management

-   Vue's Composition API with `ref` and `computed` for reactive state
-   Local storage provides persistence fallback
-   Component props and events for parent-child communication

### 4. Routing

-   Laravel handles initial page load and API routes
-   Vue handles client-side interactivity and state changes
-   Single-page application feel without a separate router

## Building for Production

1. Build optimized assets:

```bash
npm run build
```

2. Set environment to production in `.env`:

```env
APP_ENV=production
APP_DEBUG=false
```

3. Optimize Laravel:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Serve with a production web server (Nginx/Apache)

## Exposing with ngrok (or other tunnels)

When exposing your app via ngrok or similar tunneling services, you **must use a production build**. Here's why:

### Why Development Mode Doesn't Work with ngrok

In development, your app uses two servers:

-   **Laravel** on port `8000` - serves HTML and API
-   **Vite** on port `5173` - serves JavaScript/CSS with hot reloading

When you tunnel only port `8000`, the browser receives HTML that references `localhost:5173` for assets. Since `localhost:5173` isn't accessible from the internet, the JavaScript never loads and you see a **white screen**.

### Steps to Expose via ngrok

1. Build production assets:

```powershell
npm run build
```

2. Remove the hot file (stops Vite dev server references):

```powershell
Remove-Item public\hot
```

3. Ensure Laravel is running:

```powershell
php artisan serve
```

4. Start ngrok tunnel:

```powershell
ngrok http 8000
```

5. Access your ngrok URL (e.g., `https://xxxx.ngrok-free.app`)

### Switching Back to Development Mode

To return to local development with hot reloading:

```powershell
npm run dev
```

This recreates the `hot` file and enables Vite's hot module replacement again.

## Troubleshooting

### Vite fails to start

-   Ensure Node.js version is 16 or higher
-   Delete `node_modules` and `package-lock.json`, then run `npm install`
-   Check if port 5173 is already in use

### @vite directive appears as plain text

-   **Laravel 8 users**: The `@vite` directive is not natively supported. See section **6a. Laravel 8 Vite Integration Fix** in the installation steps
-   After implementing the fix, run `php artisan view:clear` to clear cached views
-   Refresh your browser - you should see script tags instead of the literal `@vite` text

### Vue app doesn't mount

-   Check browser console for errors
-   Ensure `npm run dev` is running
-   Verify the app div exists in welcome.blade.php
-   If you see `@vite` as plain text, see the troubleshooting section above

### API requests fail

-   Verify database connection in `.env`
-   Check if migrations have run: `php artisan migrate:status`
-   Ensure Laravel server is running on correct port

### Tailwind classes not working

-   Run `npm run build` or `npm run dev`
-   Verify file paths in `tailwind.config.js` content array
-   Check if files are saved and Vite is watching changes

## License

This project is open-sourced software licensed under the MIT license.

## Credits

Built with:

-   [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
-   [Vue 3](https://vuejs.org) - The Progressive JavaScript Framework
-   [Vite](https://vitejs.dev) - Next Generation Frontend Tooling
-   [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
