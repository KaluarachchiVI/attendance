<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        Student::create(['name' => 'John Doe']);
        Student::create(['name' => 'Jane Smith']);
        Student::create(['name' => 'Mark Johnson']);
    }
}
