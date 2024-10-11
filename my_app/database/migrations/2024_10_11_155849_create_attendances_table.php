<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); // Optional, if you want to keep track of each attendance record
            $table->string('student_name'); // Store student name
            $table->string('subject_name'); // Store subject name
            $table->string('status'); // Attendance status (present/absent)
            $table->date('date'); // Date of attendance
            $table->timestamps(); // Created at and updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}

