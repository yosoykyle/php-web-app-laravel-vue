# 🚀 TaskMaster - Laravel + Vue 3 Integration

Welcome to **TaskMaster**! This project demonstrates how to build a modern, robust web application using the power of **Laravel** (backend) and **Vue 3** (frontend), connected seamlessly with **Vite**.

It's designed to be a learning resource and a starter template for your own projects.

---

## ✨ Features

-   ✅ **Task Management**: Create, read, update, and delete tasks easily.
-   📊 **Real-time Stats**: See your total, completed, and pending tasks at a glance.
-   🔍 **Smart Filtering**: Toggle between "All", "Active", and "Completed" views.
-   🎨 **Modern Design**: Built with **Tailwind CSS** for a clean, responsive look.
-   📱 **Mobile Ready**: Works perfectly on phones, tablets, and desktops.
-   💾 **Auto-Save**: Uses LocalStorage so your tasks persist even if the API is down.

---

## 🛠️ Tech Stack

| Component      | Technology          | Description                                       |
| :------------- | :------------------ | :------------------------------------------------ |
| **Backend**    | 🐘 **Laravel 8.x**  | Powerful PHP framework for the API.               |
| **Frontend**   | 🟩 **Vue 3**        | Composition API for flexible component logic.     |
| **Build Tool** | ⚡ **Vite**         | Blazing fast build tool for instant HMR.          |
| **Styling**    | 🌊 **Tailwind CSS** | Utility-first framework for rapid UI development. |
| **HTTP**       | 📡 **Axios**        | For communicating between Vue and Laravel.        |

---

## 📂 Project Structure

A quick look at where the important files live:

```text
laravel-app/
├── app/
│   ├── Http/Controllers/TaskController.php  # 🧠 Controls the logic (the "Waiter")
│   └── Models/Task.php                      # 📝 Data structure (the "Blueprint")
├── resources/
│   ├── js/
│   │   ├── App.vue                          # 🏠 Main application component
│   │   └── components/                      # 🧩 Reusable UI pieces
│   └── views/
│       └── welcome.blade.php                # 🖼️ The HTML shell that holds the app
└── routes/
    └── api.php                              # 🛣️ API Route definitions
```

---

## 🚀 Getting Started

Follow these steps to get the project running on your local machine.

### 1️⃣ Prerequisites

Make sure you have these installed:

-   PHP >= 7.3
-   Node.js >= 16.x
-   Composer & NPM

### 2️⃣ Installation

Clone the repo and install dependencies:

```bash
# Clone the project
git clone <repository-url>
cd laravel-app

# Install Backend Dependencies
composer install

# Install Frontend Dependencies
npm install
```

### 3️⃣ Configuration

Set up your environment variables:

```bash
cp .env.example .env
php artisan key:generate
```

**Database Setup**:
Open `.env` and set your database connection. For a quick start, you can use SQLite:

```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, etc. can be removed or commented out for SQLite
```

Then create the database file and run migrations:

```bash
# If using SQLite
touch database/database.sqlite

# Run migrations (Create tables)
php artisan migrate
```

### 4️⃣ Run the App

You need **two** terminals running:

**Terminal 1 (Backend):**

```bash
php artisan serve
```

**Terminal 2 (Frontend - Hot Reloading):**

```bash
npm run dev
```

🚀 **Open your browser here:**  
👉 **http://localhost:8000** 👈

_(Do NOT open the file path `.../views/welcome.blade.php` directly!)_

---

## 📡 API Reference

The app uses a RESTful API to manage tasks.

| Method        | Endpoint          | Description                     |
| :------------ | :---------------- | :------------------------------ |
| 🟢 **GET**    | `/api/tasks`      | Get all tasks                   |
| 🟡 **POST**   | `/api/tasks`      | Create a new task               |
| 🔵 **PUT**    | `/api/tasks/{id}` | Update a task (toggle complete) |
| 🔴 **DELETE** | `/api/tasks/{id}` | Remove a task                   |

---

## ❓ Common Issues

**🤔 I see a white screen!**

-   Check your browser console (F12) for errors.
-   Ensure `npm run dev` is running.

**🤔 The "@vite" text appears on the screen.**

-   Use the built-in fix: Run `php artisan view:clear`.
-   Ensure `AppServiceProvider.php` has the `viteTags` helper (included by default).

**🤔 API requests are failing.**

-   Check if your database is connected.
-   Run `php artisan migrate:status` to ensure tables exist.

---

## 📄 License

Open-sourced software licensed under the **MIT license**.
