# Asset Management System

A web-based **Asset Management System** developed using **PHP, MySQL, HTML, CSS, and JavaScript**. The system helps organizations manage IT assets, track purchases, assign assets to employees, handle support tickets, and maintain transaction records efficiently.

---

## Features

- 🔐 Secure User Login
- 📦 Asset Management
- 🛒 Purchase Management
- ✅ Purchase Approval
- 📝 Asset Assignment
- 👤 Employee Asset Tracking
- 🎫 Raise and Manage Support Tickets
- 📊 Transaction History
- 📄 Export Purchase Records
- 🔑 Forgot Password Functionality

---

## Technology Stack

### Frontend
- HTML5
- CSS3
- JavaScript

### Backend
- PHP

### Database
- MySQL

### Server
- WAMP Server / XAMPP

---

## Project Structure

```
Asset Management System/
│
├── CSS/                # Stylesheets
├── DB_Config/          # Database connection
├── Images/             # Images and icons
├── Main/               # Backend PHP logic
├── Pages/              # User interface pages
└── README.md
```

---

## Main Modules

### User Authentication
- Login
- Forgot Password

### Purchase Management
- Add Purchase
- Purchase Record
- Purchase Approval
- Purchase Update

### Asset Management
- Asset List
- Asset Assignment
- My Assets
- Asset Edit

### Ticket Management
- Raise Ticket
- Ticket Details
- Ticket Update

### Reports
- Transaction History
- Export Purchase Records

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/Asset-Management-System.git
```

### 2. Move the project

Copy the project folder into your WAMP/XAMPP `www` directory.

Example:

```
C:\wamp64\www\
```

### 3. Create the database

- Open **phpMyAdmin**
- Create a new database.
- Import the SQL file (if included).

### 4. Configure database connection

Open:

```
DB_Config/Config.php
```

Update the database credentials:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "YOUR_DATABASE_NAME";
```

### 5. Start the server

Start:

- Apache
- MySQL

using WAMP or XAMPP.

### 6. Open the project

```
http://localhost/Asset%20Management%20System/Pages/Login.php
```

---

## Screenshots

You can add screenshots here after uploading your project.

Example:

```
screenshots/
├── login.png
├── dashboard.png
├── asset-list.png
├── purchase-record.png
```

---

## Future Enhancements

- Email Notifications
- Dashboard Analytics
- QR Code Asset Tracking
- Barcode Scanner Integration
- Role-Based Access Control
- Asset Depreciation Reports
- Responsive Mobile Design

---

## Author

**Muthulakshmi P**

- Final Year B.Tech Artificial Intelligence and Data Science Student
- Interested in Software Testing, Full Stack Development

---

## License

This project was developed by me during my internship as part of my training and practical learning. It is shared on GitHub to demonstrate my technical skills and project experience.
