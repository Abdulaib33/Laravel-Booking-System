
---

# 2. Laravel Appointment Booking System — polished GitHub README


# Laravel Appointment Booking System

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1)
![Blade](https://img.shields.io/badge/Blade-Templating-orange)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-UI-38B2AC)
![Status](https://img.shields.io/badge/Status-Portfolio%20Project-success)

A booking management application built with Laravel.

Users can submit appointment requests, while administrators manage services and booking statuses through an admin dashboard.

## 🚀 Live Demo

- 🌐 Demo: [https://laravel-booking-system-production-aaee.up.railway.app/book](https://laravel-booking-system-production-aaee.up.railway.app/book)
- 🔐 Admin: [https://laravel-booking-system-production-aaee.up.railway.app/admin/bookings](https://laravel-booking-system-production-aaee.up.railway.app/admin/bookings)

***

## 🔐 Demo Credentials

### 🛠️ Admin
- **Email:** admin@example.com  
- **Password:** password

### ✏️ Editor
- **Email:** editor@example.com  
- **Password:** password

### 👀 Guest
- **Email:** guest@example.com  
- **Password:** password


***

# ✨ Features

- Authentication
- Appointment booking form
- Services management
- Admin booking dashboard
- Booking status workflow
- Status filtering in admin panel
- Validation and friendly error messages
- Double-booking prevention
- Eloquent relationships between users, services, and bookings

---


## 🧠 Technical Highlights
- **Laravel MVC architecture**
- **Eloquent relationships (User ↔ Booking ↔ Service)**
- **Server-side validation**
- **Custom business rules (double booking prevention)**
- **Role-based middleware**
- **Clean separation between user and admin flows**


---

## 🖼️ Screenshots

### Booking Form
![Booking Form](./screenshots/booking-form.png)

### Admin Bookings Dashboard
![Admin Bookings](./screenshots/admin-bookings.png)

### Services Management
![Services](./screenshots/services.png)


---


# 🚀 Tech Stack

**Backend**
- PHP
- Laravel

**Frontend**
- Blade
- Tailwind CSS

**Database**
- MySQL

**Infrastructure**
- Railway (deployment)

**Tools**
- Git
- GitHub
- Linux
- Apache

---

## Installation

```bash
git clone https://github.com/yourusername/laravel-booking-system.git
cd laravel-booking-system
composer install
npm install
cp .env.example .env
php artisan key:generate


Configure .env, then:

php artisan migrate --seed
npm run build
php artisan serve
```

***

## 🗺️ Roadmap
- Email notifications for booking updates
- User booking history
- Time slot automation
- Calendar view for admin
- API version

***

## 👤 Author
Built as a portfolio project to demonstrate Laravel business logic, booking workflows, and admin dashboard development.