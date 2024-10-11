<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;

class StudentSubjectSeeder extends Seeder
{
    public function run()
    {
        // Fetch all students and subjects
        $students = Student::all();
        $subjects = Subject::all();

        // Attach random subjects to each student
        foreach ($students as $student) {
            $student->subjects()->attach(
                $subjects->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}

