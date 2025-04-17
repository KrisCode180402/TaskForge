# TaskForge

TaskForge is a modern, web‑based Task Management System built on CodeIgniter 4. It helps teams manage tasks more efficiently with a clean, dynamic, and user‑friendly interface. The system is designed for flexibility and easy extension with additional features.

---

## Overview

**1. Core Features**  
- **User Authentication & Role Management**  
  - Secure registration, login, logout  
  - Three roles: **Admin**, **Manager**, **Employee**  
    - Admins manage users & oversee all tasks  
    - Managers create/assign tasks and monitor progress  
    - Employees view and update status of their tasks  
- **Task CRUD Operations**  
  - Create, Read, Update, Delete tasks  
  - Each task has a title, description, due date, and status  
- **Enhanced Task Status Handling**  
  - Statuses (“To‑Do”, “In‑Progress”, “Done”) stored in a dedicated table  
  - Easily add or customize statuses without code changes  

**2. UI/UX**  
- **Responsive Design** with Bootstrap for desktop & mobile  
- **Interactive Elements** via JavaScript & jQuery (e.g., drag‑and‑drop)  

**3. Extensibility & Future Enhancements**  
- **API Integration** (build RESTful endpoints for mobile/third‑party use)  
- **Advanced Permissions** (custom roles, granular action controls)  
- **Real‑Time Updates** (WebSockets or AJAX polling for live task status)  

---

## Table of Contents

- [Technologies Used](#technologies-used)  
- [Requirements](#requirements)  
- [Installation](#installation)  
- [Usage](#usage)  

---

## Technologies Used

- **PHP 7.4+**
- **HTML/CSS/JavsScript**
- **CodeIgniter 4** (installed via Composer)  
- **MySQL** (managed with phpMyAdmin)  
- **Bootstrap**  
- **jQuery & AJAX**  
- **XAMPP** (Apache, PHP, MySQL)  
- **Composer 2**  

---

## Requirements

Before you begin, ensure you have:

- **XAMPP** (Apache, PHP, MySQL) installed locally  
- **Composer 2** for PHP dependencies  
- **phpMyAdmin** for database management  
- PHP extensions: `intl`, `mbstring`, `curl`

---

## Installation

1. **Clone the repository**  
   git clone https://github.com/yourusername/TaskForge.git  
   cd TaskForge

2. **Import the Database**  
   Open phpMyAdmin at http://localhost/phpmyadmin  
   Create a new database named taskforge  
   Go to Import, choose taskforge.sql, and click Go

3. **Configure Environment**  
   cp env .env
    
   Edit .env:  
   app.baseURL = 'http://localhost/TaskForge/public/'  
   database.default.database = taskforge  
   database.default.username = root  
   database.default.password =

5. **Install PHP Dependencies**  
   composer install

6. **Serve the Application Locally**  
   php spark serve  
   Visit http://localhost:8080 in your browser

---

## Usage

**Register a new account at /auth/register**  
**Log in at /auth/login**  

**Dashboard Roles:**  
-  Admins   – manage users & all tasks  
-  Managers – create/assign tasks & view team progress  
-  Employees– update status of assigned tasks  

**Task Operations:**  
-   Add    – click “Add New Task”  
-   Edit   – click the edit button (modal form)  
-   Delete – click the delete button, confirm removal  
-   Search – type in the search box for live suggestions  

 **Logout via the “Logout” button in the header**

---



