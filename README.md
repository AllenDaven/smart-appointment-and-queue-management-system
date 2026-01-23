# 📅 Appointment Booking System (Capstone Project)

## 📌 Project Overview
The **Appointment Booking System** is a web-based application developed as a capstone project.  
It allows users to securely book appointments by selecting an available date and time.  
The system improves scheduling efficiency and reduces manual appointment handling.

This project demonstrates the use of **Laravel**, **Blade Templates**, **Tailwind CSS**, and **MySQL** following modern web development practices.

---

## 🚀 Features
- User authentication (Register, Login, Logout)
- Appointment booking (date & time selection)
- Office-hours validation (9:00 AM – 5:00 PM)
- Admin appointment approval
- View booked appointments
- Responsive and modern UI
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


---

## ⚙️ How to Run the Project (Local Setup)

### ✅ Prerequisites
Ensure the following are installed:
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & NPM
- Laravel CLI (optional)

---

### 📥 Step 1: Clone the Repository
```bash
git clone https://github.com/your-username/appointment-booking-system.git
cd appointment-booking-system

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