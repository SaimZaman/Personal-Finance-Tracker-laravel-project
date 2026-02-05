
# 💰 Personal Finance Management System

A modern web application built with **Laravel 12** and **Livewire** for managing personal finances, tracking transactions, and monitoring financial health in real time.


## 📸 Screenshots

### 🔐 Authentication

![Login](screenshots/login.png)
![Register](screenshots/register.png)

### 📊 Dashboard

![User Dashboard](screenshots/user-dashboard.png)

### 🛠️ Admin Panel

![Admin Dashboard](screenshots/admin-dashboard.png)
![User Management](screenshots/user-management.png)


# 🚀 Features

### 💵 Transaction Management

* Add, edit, and delete income/expense transactions
* Category-based organization
* Date tracking
* Automatic income, expense & balance calculation

### 📊 Financial Dashboard

* Real-time financial overview
* Total income & expenses summary
* Current balance tracking

### 👥 User & Role Management

* Secure authentication (Jetstream + Fortify)
* Admin & Regular User roles
* Role-based dashboards
* Admin can activate/deactivate users
* Users can access only their own data

### 🔒 Security

* Middleware-protected routes
* CSRF protection
* Session management
* User data isolation


# 🛠️ Tech Stack

**Backend**

* Laravel 12
* PHP 8.2+
* Livewire 3
* SQLite (default) / MySQL

**Frontend**

* Tailwind CSS 4
* Bootstrap
* Livewire Volt & Flux
* Blade Templates
* Vite


# 📋 Requirements

* PHP 8.2+
* Composer
* Node.js 18+
* MySQL(Xhamp)
* Git

---

# ⚙️ Installation

## 1️⃣ Clone the Repository

```bash
git clone <repository-url>
cd personal-finance-app
```

---

## 2️⃣ Install PHP Dependencies

```bash
composer install
```

---

## 3️⃣ Install Node Dependencies

```bash
npm install
```

---

## 4️⃣ Setup Environment File

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## 5️⃣ Configure Database

### Using mysql

Create the database file


Make sure your `.env` contains:

```env
DB_CONNECTION=mysql
```

Run migrations:

```bash
php artisan migrate
```

---

### Using MySQL

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then run:

```bash
php artisan migrate
```

---



## 7️⃣ Start the Application

Run the Laravel development server:

```bash
php artisan serve
```

The application will be available at:

👉 [http://127.0.0.1:8000](http://127.0.0.1:8000)


---

# 👤 Usage

**Regular Users**

* Register/Login
* Add & manage transactions
* View dashboard summary

**Admins**

* Manage users
* Activate/deactivate accounts
* Access admin dashboard

---






