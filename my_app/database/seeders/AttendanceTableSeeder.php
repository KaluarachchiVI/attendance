<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Subject;

class AttendanceTableSeeder extends Seeder
{
    public function run()
    {
        // Fetch all students and subjects
        $students = Student::all();
        $subjects = Subject::all();

        // Check if we have students and subjects to associate
        if ($students->isEmpty() || $subjects->isEmpty()) {
            $this->command->info('No students or subjects available to seed attendance.');
            return;
        }

        // Create sample attendance records
        foreach ($students as $student) {
            // Randomly assign a subject to the student
            $subject = $subjects->random();

            Attendance::create([
                'student_name' => $student->name, // Store student name
                'subject_name' => $subject->name,  // Store subject name
                'status' => (rand(0, 1) ? 'present' : 'absent'), // Randomly assign present/absent
                'date' => now()->toDateString(), // Today's date
            ]);
        }
    }
}
