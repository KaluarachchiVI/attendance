<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        Subject::create(['name' => 'Mathematics']);
        Subject::create(['name' => 'Physics']);
        Subject::create(['name' => 'Chemistry']);
        Subject::create(['name' => 'Biology']);
        Subject::create(['name' => 'English']);
    }
}
