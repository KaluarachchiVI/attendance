<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship with Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relationship with Subject (if a student can have multiple subjects)
    public function subjects()
{
    return $this->belongsToMany(Subject::class);
}

}
