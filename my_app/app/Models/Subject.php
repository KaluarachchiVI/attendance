<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship with Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relationship with Student (if a subject can have multiple students)
    public function students()
{
    return $this->belongsToMany(Student::class);
}

}
