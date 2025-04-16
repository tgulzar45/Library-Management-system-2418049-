# Library Management System

A web-based Library Management System built with PHP and MySQL. It allows users to browse and borrow books, and admins to manage books and users. This system was developed as part of the **CMM007** module for academic submission at Robert Gordon University.

---

## Features

- User login and registration
- Book browsing with genre-based filtering
- Book borrowing (limited to 3 books at a time)
- 14-day return period for each borrowed book
- Display of due dates for borrowed books
- Admin dashboard to manage:
- Books (add, update, delete)
- Users (create, update, delete)
- Loan records

---
## Screenshots & Illustrations

### System Flow

![System Overview](/illustration.png)

### UI Background Inspiration

![UI Background](/Londonjpg.jpeg)

---

## Default Admin Login

- **Email**: `admin@live.com`  
- **Password**: `123456`

## Technologies Used

- PHP 8
- MySQL
- HTML5 / CSS3
- JavaScript
- Apache (via XAMPP)
- phpMyAdmin (for database management)

---

## How to Run Locally

1. Install **XAMPP** from [https://www.apachefriends.org](https://www.apachefriends.org)
2. Place the `CMM007` project folder inside the `htdocs` directory:
   - On macOS: `/Applications/XAMPP/htdocs/`
3. Open **XAMPP Control Panel** and start **Apache** and **MySQL**
4. Open [http://localhost/phpmyadmin](http://localhost/CMM007/
5. Create a new database named `library_system`
6. Import the SQL database file (if provided):  
   _Database → Import → Choose File → Select `library_system.sql` → Go_
7. Open the project in your browser:  
   [http://localhost/CMM007](http://localhost/CMM007)
8. Ensure your `config.php` file contains the correct database credentials:
   ```php
   $conn = new PDO("mysql:host=localhost;dbname=library_system", "root", "");
