Attendance Tracker System
Description
The Attendance Tracker System is a Laravel-based web application designed to help educational institutions efficiently manage and track student attendance records. The system provides a user-friendly interface for teachers to record and monitor student attendance across different subjects.
Features

User authentication for teachers and administrators
Student registration and management
Subject/course management
Daily attendance marking
Attendance reports and analytics
Filter attendance records by date and subject
Calculate attendance percentages automatically
Export attendance data to CSV/PDF

Technologies Used

Laravel: Backend framework
MySQL: Database management
PHP: Server-side programming
HTML/CSS: Frontend structure and styling
JavaScript: Interactive features
Composer: Dependency management

Requirements

PHP >= 8
Composer
MySQL Database
Node.js and NPM

Installation Steps

Clone the repository
Install dependencies using Composer
Configure environment settings
Set up the database
Run migrations
Start the application

Database Structure
The system includes four main tables:

Users (teachers/administrators)
Students
Subjects
Attendances

Setup Instructions

step 1:

# Clone repository
git clone <repository-url>

# Install dependencies
composer install

# Configure environment
cp .env.example .env

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate

# Start server
php artisan serve

step 2:
Update your .env file with database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

Usage

Register/login as a teacher
Add students to the system
Create subjects
Mark daily attendance
Generate attendance reports
