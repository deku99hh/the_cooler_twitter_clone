# 🐦 the_cooler_twitter_clone

A and custom-built Twitter clone engineered using **Pure PHP (Vanilla PHP)** with an emphasis on clean architecture, design principles, and custom core components.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Architecture](https://img.shields.io/badge/Architecture-MVC%20%2B%20SOLID-orange?style=for-the-badge)
![Database](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

---

## 📌 Project Overview

This project marks my first hands-on application of the **MVC (Model-View-Controller)** pattern and **SOLID design principles** built entirely from scratch in vanilla PHP. It provides full control over routing, database querying, business logic separation, and interface rendering.

---

## 🔥 Highlight: Custom `QueryBuilder.php`

One of the proudest highlights of this project is a custom-built **`QueryBuilder`** located within the core layer. Inspired by modern ORMs (Object-Relational Mappers), it abstracts complex SQL operations into an intuitive, chainable, and type-safe PHP interface while protecting against SQL injection using prepared statements.

### Features of the QueryBuilder:
- **Security First:** Built-in parameter binding via PDO to prevent SQL Injection.
- **Core CRUD Abstraction:** Flexible methods for `SELECT`, `INSERT`, `UPDATE`, `DELETE`, `WHERE` clauses, joins, and data binding.

---

## 🏗️ Architecture & Key Features

* **Custom MVC Framework:** Complete separation of concerns:
  * `Models` handle domain logic and database interactions.
  * `Views` render dynamic UI components.
  * `Controllers` process requests, coordinate business logic, and deliver responses.
* **SOLID Principles:** Applied interfaces (`Contracts`), service dependency separation (`Services`), and modular responsibilities across the core utilities.
* **Single Point of Entry:** All requests are safely routed through `public/index.php` using front-controller routing via `.htaccess`.
* **Clean Configuration Management:** Environment-based config isolation (`.env`, `config.ini`).

---

## 📁 Directory Structure

```text
the_cooler_twitter_clone/
│
├── app/                      # Main Application Logic
│   ├── Contracts/            # Interfaces for SOLID abstraction
│   ├── Controllers/          # Request handlers
│   ├── Core/                 # Framework core (Router, QueryBuilder, Database, etc.)
│   ├── Models/               # Data models and database logic
│   ├── Services/             # Business logic and auxiliary services
│   ├── Views/                # UI Templates / Layouts
│   ├── .htaccess             # App directory protection
│   ├── composer.json         # Autoloading configuration
│   ├── composer.lock         
│   ├── config.ini            # Application configuration settings
│   └── init.php              # Application bootstrapping script
│
├── public/                   # Web Root (Publicly Accessible)
│   ├── .htaccess             # URL Rewriting rule (Front Controller)
│   └── index.php             # Application entry point
│
├── .env.example              # Sample environment file
├── .gitignore                # Git exclusion rules
├── .htaccess                 # Main root rewrites
└── db.sql                    # Database schema and initial seeds
```

---

## 🚀 Getting Started

Follow these steps to set up and run the project locally on your machine.

### Prerequisites

Ensure you have the following installed:
* **PHP** (v8.0 or higher recommended)
* **MySQL / MariaDB** database server
* **Apache** web server (with `mod_rewrite` enabled) or **XAMPP / Laragon / Local Server**
* **Composer** (for class autoloading)

---

### Installation & Setup

1. **Clone the Repository**
   ```bash
   git clone [https://github.com/YOUR_USERNAME/the_cooler_twitter_clone.git](https://github.com/YOUR_USERNAME/the_cooler_twitter_clone.git)
   cd the_cooler_twitter_clone
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   Open `.env` and update your database credentials accordingly:
   ```ini
   DB_HOST=127.0.0.1
   DB_NAME=twitter_clone
   DB_USER=root
   DB_PASS=your_password
   ```

4. **Import the Database Schema**
   ```bash
   mysql -u root -p twitter_clone < db.sql
   ```

5. **Serve the Application**
   ```bash
   php -S localhost:8000 -t public
   ```
   Then visit `http://localhost:8000` in your browser.

---

## 💡 What I Learned

Through building this project, I gained deep hands-on experience in:
- Designing a modular **MVC architecture** from scratch in Pure PHP.
- Applying **SOLID principles** to maintain readable, decoupled, and testable code.
- Building custom core utilities including a custom **Query Builder / ORM prototype**.
- Managing secure database connections with PDO parameter binding.
- Understanding URL rewrite rules and Front-Controller design pattern using `.htaccess`.

