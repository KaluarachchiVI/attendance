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

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/yourusername/attendance-tracker.git](https://github.com/KaluarachchiVI/attendance.git)
Step 2: Navigate to the Project Directory
bashCopycd attendance-tracker
Step 3: Install Dependencies
Install the necessary PHP packages using Composer:
bashCopycomposer install
Step 4: Set Up the Environment File
Copy the example environment file to create your .env file:
bashCopycp .env.example .env
Step 5: Generate an Application Key
Generate an application key for your Laravel application:
bashCopyphp artisan key:generate
Step 6: Configure Database Settings
Open the .env file and update your database connection settings:
envCopyDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
Step 7: Create Database Tables
The application requires several database tables. Create them using Laravel migrations:
bashCopyphp artisan make:migration create_users_table
php artisan make:migration create_students_table
php artisan make:migration create_subjects_table
php artisan make:migration create_attendances_table
Step 8: Define the Migrations
Users Table Migration
phpCopyuse Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
Students Table Migration
phpCopyuse Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
Subjects Table Migration
phpCopyuse Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
Attendances Table Migration
phpCopyuse Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->string('student_name');
            $table->string('subject_name');
            $table->string('status');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
Step 9: Run the Migrations
Run the migrations to create the database tables:
bashCopyphp artisan migrate
Step 10: Seed the Database (Optional)
If you have a seeder set up for initial data:
bashCopyphp artisan db:seed
Step 11: Run the Application
Start the Laravel development server:
bashCopyphp artisan serve
Visit http://localhost:8000 in your browser to access the application.
