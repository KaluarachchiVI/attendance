# Attendance Tracker System

## Description
The Attendance Tracker System is a web application designed to help educational institutions manage student attendance efficiently. The system allows teachers to mark attendance for students enrolled in various subjects and track their attendance percentages.

## Features
- Mark attendance for students on a daily basis.
- Filter attendance records by subject and date range.
- Display a list of students with their individual attendance percentages.
- Responsive and user-friendly interface.

## Technologies Used
- **Laravel**: PHP framework for backend development.
- **MySQL**: Database management system for storing records.
- **HTML/CSS**: For frontend structure and styling.
- **JavaScript**: For dynamic filtering of students based on selected subjects.

## Requirements
- PHP 8.0 or higher
- Composer
- MySQL

## Installation

1️⃣ Clone the Repository
bashCopygit clone https://github.com/KaluarachchiVI/attendance.git
2️⃣ Install Dependencies
bashCopy# Navigate to project directory
cd attendance-tracker

# Install PHP dependencies
composer install

# Install NPM packages
npm install && npm run dev
3️⃣ Configure Environment
bashCopy# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate
Update .env with your database credentials:
envCopyDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
4️⃣ Database Setup
bashCopy# Run migrations
php artisan migrate

# (Optional) Seed the database
php artisan db:seed
5️⃣ Launch the Application
bashCopyphp artisan serve
Visit http://localhost:8000 in your browser.
🏗️ Database Structure
Users Table
phpCopySchema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
Students Table
phpCopySchema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
Subjects Table
phpCopySchema::create('subjects', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
Attendances Table
phpCopySchema::create('attendances', function (Blueprint $table) {
    $table->string('student_name');
    $table->string('subject_name');
    $table->string('status');
    $table->date('date');
    $table->timestamps();
});
🔧 Configuration
Key configuration files are located in:

config/app.php - Application configuration
config/database.php - Database configuration
config/auth.php - Authentication configuration

🛣️ API Routes
Document your API routes here using the following format:
CopyGET /api/students - Retrieve all students
POST /api/attendance - Record attendance
🧪 Running Tests
bashCopyphp artisan test
