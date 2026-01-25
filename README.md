# 📅 QueueSmart: A Web-Based Smart Appointment and Queue Management System  
*(Capstone Project)*

---

## 📌 Project Overview
**QueueSmart** is a web-based appointment and queue management system developed as a capstone project.  
It enables users to securely book appointments while allowing administrators to manage, approve, reject, and monitor appointments efficiently.

The system minimizes manual scheduling, improves service flow, and provides role-based dashboards for users and administrators.

This project is built using **Laravel**, **Blade Templates**, **Tailwind CSS**, and **MySQL**, following modern web development best practices.

---

## 🚀 Features

### 👤 User / Client Features
- User registration with validation (email uniqueness, password confirmation)
- Secure login and logout
- Appointment booking with date and time selection
- View appointment details and status (Pending, Approved, Rejected)
- Cancel booked appointments
- User-specific dashboard
- Role-based navigation (admin-only pages hidden from users)

### 🛠️ Admin / Staff Features
- Admin login authentication
- Appointment approval and rejection
- View all appointments
- Appointment status management (Pending, Approved, Rejected)
- Admin dashboard with analytics:
  - Total users
  - Total appointments
  - Approved, Rejected, and Pending counts

### 🌐 System Features
- Office-hours validation (9:00 AM – 5:00 PM)
- Role-based access control
- Responsive UI (mobile, tablet, desktop)
- Success and error notifications
- Secure form submission with CSRF protection

---

## 🛠️ Technologies Used
- **Backend:** Laravel (PHP)
- **Frontend:** Blade Templates, Tailwind CSS
- **Database:** MySQL
- **Tools:** Composer, Node.js, NPM
- **Version Control:** Git

---

## ⚙️ How to Run the Project (Local Setup)

### ✅ Prerequisites
Ensure the following are installed:
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & NPM
- Git

---

### 📥 Steps to run this Project.
```bash
Step 1: Clone the repository
git clone https://github.com/your-username/queuesmart.git
cd queuesmart

📦 Step 2: Install Dependencies
composer install
npm install
npm run dev

🔐 Step 3: Environment Setup
Create the environment file:
cp .env.example .env

Generate the application key:
php artisan key:generate

🗄️ Step 4: Database Configuration
Edit the .env file:
DB_DATABASE=appointment_db
DB_USERNAME=root
DB_PASSWORD=

Create the database in MySQL:
CREATE DATABASE appointment_db;

Run migrations and seeders:
php artisan migrate --seed

▶️ Step 5: Run the Application
php artisan serve
