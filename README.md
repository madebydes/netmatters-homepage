# Netmatters Homepage Clone

A PHP conversion of the Netmatters website homepage with database integration.

## Features

- ✅ Responsive design matching the original Netmatters website
- ✅ PHP includes for reusable components (header, footer, sidebar, etc.)
- ✅ MySQL database integration for news posts
- ✅ Contact page with form validation (client-side and server-side)
- ✅ Contact form submissions stored in database
- ✅ SCSS compilation with modular architecture

## Requirements

- PHP 7.4+ (PHP 8.0+ recommended)
- MySQL 5.7+ or MariaDB 10.3+
- Apache/Nginx web server with mod_rewrite
- XAMPP, WAMP, MAMP, or similar local development environment

## Installation

### 1. Clone/Copy Files

Copy the project files to your web server's document root:
- XAMPP: `C:\xampp\htdocs\netmatters-homepage`
- MAMP: `/Applications/MAMP/htdocs/netmatters-homepage`

### 2. Create Database

1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named `netmatters`
3. Import `database/schema.sql` to create tables and seed data

### 3. Configure Environment

1. Copy `.env.example` to `.env`
2. Update database credentials if needed:

```
DB_HOST=localhost
DB_NAME=netmatters
DB_USER=root
DB_PASS=
DB_CHARSET=utf8mb4
```

### 4. Add Office Images (for Contact Page)

Create the folder `img/offices/` and add:
- `cambridge.jpg`
- `wymondham.jpg`
- `great-yarmouth.jpg`

### 5. Access the Site

- Homepage: http://localhost/netmatters-homepage/
- Contact: http://localhost/netmatters-homepage/contact-us.php

## Project Structure

```
netmatters-homepage/
├── app/
│   ├── js/                  # JavaScript files
│   │   ├── banner.js
│   │   ├── contact.js       # Contact form validation
│   │   ├── cookies.js
│   │   ├── header.js
│   │   ├── partners.js
│   │   ├── sidebar.js
│   │   └── sticky-header.js
│   └── scss/
│       ├── globals/         # Variables, colors, mixins
│       ├── layout/          # Component styles
│       └── style.scss       # Main stylesheet
├── classes/
│   ├── Contact.php          # Contact form handling
│   ├── Database.php         # Database singleton
│   └── News.php             # News posts model
├── config/
│   ├── database.php         # DB configuration
│   └── init.php             # Application bootstrap
├── database/
│   └── schema.sql           # Database schema & seed data
├── dist/
│   └── style.css            # Compiled CSS
├── fonts/
├── img/
├── includes/
│   ├── cookies.php
│   ├── footer.php
│   ├── head.php
│   ├── header.php
│   ├── scripts.php
│   └── sidebar.php
├── .env.example
├── contact-us.php           # Contact page
└── index.php                # Homepage
```

## Database Tables

### news_posts
Stores news/blog posts displayed on the homepage.

### contact_submissions
Stores contact form submissions with fields:
- name, email, phone, company, message
- marketing_consent
- ip_address, submitted_at

## SCSS Compilation

If you need to modify styles:

1. Install Live Sass Compiler in VS Code, or
2. Run: `sass --watch app/scss/style.scss:dist/style.css`

## Testing

1. Visit the homepage - news posts should load from the database
2. Visit contact page - form validation should work
3. Submit a contact form - check phpMyAdmin for new entries

## License

Educational project - Netmatters branding belongs to Netmatters Ltd.
