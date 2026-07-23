# 🛒 POS Management System

A web-based Point of Sale (POS) Management System developed using **Laravel, PHP, AJAX, and MySQL** as a university academic project.

This system is designed to help businesses manage their daily operations efficiently, including products, categories, customers, sales, invoices, reports, and other essential business activities through a centralized platform.

---

## 📌 About the Project

The POS Management System provides a centralized platform for managing day-to-day business operations.

The system allows administrators to manage products, categories, customers, sales, invoices, and reports efficiently. AJAX has been used for dynamic data operations to improve the user experience and reduce unnecessary page reloads.

This project was developed as part of my **university academic project** and helped me gain practical experience in developing real-world business management applications using the Laravel framework.

---

## ✨ Features

### 🔐 Authentication

* User Registration
* User Login
* User Logout
* Authentication System

### 📊 Dashboard

* Overview of business activities
* Sales summary
* Product overview
* Customer overview
* Business statistics

### 📦 Product Management

* Add New Product
* Update Product
* Delete Product
* View Product Details
* Product Management

### 🗂️ Category Management

* Add Category
* Update Category
* Delete Category
* Manage Product Categories

### 👥 Customer Management

* Add Customer
* Update Customer
* Delete Customer
* View Customer Information

### 🛍️ Sales Management

* Create New Sale
* Select Products
* Manage Sale Items
* Calculate Total Amount
* Process Sales

### 🧾 Invoice Management

* Generate Invoice
* View Invoice Details
* Manage Invoice Records
* Invoice List

### 📈 Reports

* View Sales Reports
* Analyze Business Activities
* Generate Useful Business Information

### ⚙️ Settings

* Manage Business Settings
* Update System Information

### ⚡ AJAX Integration

AJAX was used to perform dynamic operations without requiring full page reloads.

* AJAX-based data operations
* Dynamic form submissions
* Asynchronous requests
* Improved user experience
* Reduced unnecessary page reloads

---

## 🛠️ Technologies Used

### Backend

* PHP
* Laravel
* MySQL

### Frontend

* HTML5
* CSS3
* Bootstrap 5
* JavaScript
* AJAX
* Blade Template Engine

### Development Concepts

* MVC Architecture
* Eloquent ORM
* CRUD Operations
* Authentication
* Database Management
* RESTful Routing
* Form Validation
* AJAX Requests

### Development Tools

* Visual Studio Code
* XAMPP
* Composer
* Git
* GitHub

---

## 🏗️ Project Architecture

This project follows the **MVC (Model-View-Controller)** architecture of the Laravel framework.

### Model

Handles database interactions using Laravel's **Eloquent ORM**.

### View

The user interface was developed using the **Blade Template Engine**, HTML5, CSS3, Bootstrap, and JavaScript.

### Controller

Handles application logic, user requests, data processing, and communication between Models and Views.

---

## ⚡ AJAX Implementation

AJAX was implemented to improve the application's interactivity and user experience.

Instead of refreshing the entire page after every operation, AJAX requests allow the application to communicate with the server asynchronously.

### Example Operations

* Fetching data dynamically
* Submitting forms asynchronously
* Updating records
* Deleting records
* Performing dynamic data operations

This helps create a smoother and more responsive user experience.

---

## 🗄️ Database

The project uses **MySQL** as the database management system.

The database stores and manages information related to:

* Users
* Products
* Categories
* Customers
* Sales
* Invoices
* Business Information

Laravel migrations were used to manage the database structure.

---

## 📸 Screenshots

Add your project screenshots here.

### Dashboard

![Dashboard](screenshots/dashboard.png)

### Product Management

![Product Management](screenshots/products.png)

### Sales Management

![Sales Management](screenshots/sales.png)

### Invoice

![Invoice](screenshots/invoice.png)

---

## 🚀 Installation & Setup

Follow the steps below to run the project locally.

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/your-repository-name.git
```

### 2. Navigate to the Project Directory

```bash
cd your-repository-name
```

### 3. Install PHP Dependencies

```bash
composer install
```

### 4. Create the Environment File

For Windows:

```bash
copy .env.example .env
```

For Linux/macOS:

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database

Open the `.env` file and configure your database:

```env
DB_DATABASE=pos
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Run Database Migrations

```bash
php artisan migrate
```

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Start the Development Server

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## 🎯 Learning Outcomes

Through this project, I gained practical experience in:

* Developing web applications using Laravel
* Understanding MVC Architecture
* Building CRUD functionality
* Working with MySQL databases
* Using Laravel Eloquent ORM
* Implementing Authentication
* Using AJAX for asynchronous data operations
* Managing forms and validation
* Designing database structures
* Building real-world business management applications
* Working with Git and GitHub

---

## 🔮 Future Improvements

Possible future improvements include:

* Role-Based Access Control
* Inventory Management
* Stock Management
* Low Stock Notifications
* Advanced Sales Analytics
* PDF Invoice Generation
* Online Payment Integration
* REST API Integration
* Multi-branch Business Management
* Advanced Reporting System

---

## 🎓 Project Type

**University Academic Project**

---

## 👨‍💻 Developer

**Wazihatulla Wasti**

Laravel Developer | PHP Developer

---

## 📄 License

This project was developed for educational and academic purposes.
