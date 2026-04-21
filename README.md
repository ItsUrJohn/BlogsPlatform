# 📝 BlogPlatform - Modern Blogging Platform

A full-featured blogging platform built with Laravel, featuring dark mode, user profiles, admin dashboard, team management, and more.

## ✨ Features

- **User Authentication** – Register, login, logout, password reset via email
- **Dark Mode** – Toggle between light/dark themes (persists in localStorage)
- **Profile Management** – Upload/remove profile pictures
- **Blog Posts** – Create, edit, delete your own posts
- **Public Feed** – Latest posts from all users on landing page
- **Contact Form** – Messages stored in database for admin review
- **Admin Dashboard** – Charts, user statistics, contact management, user management
- **Team Management** – Add/edit/delete team members (admin only)
- **Responsive Design** – Works on desktop, tablet, and mobile

## 🛠️ Tech Stack

| Technology | Version |
|------------|---------|
| Laravel | 11.x |
| PHP | 8.2+ |
| MySQL | 5.7+ |
| JavaScript (ES6) | – |
| Chart.js | – |
| Font Awesome | 6.4 |

## 📋 Prerequisites

Make sure you have the following installed:

- [PHP](https://www.php.net/downloads) >= 8.2
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://www.mysql.com/downloads/) or MariaDB
- [Node.js](https://nodejs.org/) (optional, for asset compilation)
- [Git](https://git-scm.com/)

## 🚀 Local Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/blogplatform.git
cd blogplatform

Step 1 Install PHP Dependencies
    composer install
Step 2 Create Environment File
    cp .env.example .env
Step 3 Configure Database
    Open .env and update these lines with your database credentials:
    change into this 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=blogplatform
    DB_USERNAME=root
    DB_PASSWORD=yourpassword
Step 4 Generate Application Key
    php artisan key:generate
Step 5 Generate Application Key
    php artisan key:generate
step 6 Run Migrations
    php artisan migrate
Step 7 Create a database
   laravelproject.db
   then import the file laravelproject_db.sql
Login As Admin
User: Admin
Pass: Password123
