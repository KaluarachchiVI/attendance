<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject_id', 'date', 'status']; // Make sure these fields are correct

    // Define the relationship to the Student model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Define the relationship to the Subject model
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
