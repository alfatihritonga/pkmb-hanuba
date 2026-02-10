<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'name',
        'gender',
        'birth_date',
        'address',
    ];

    public function classAssignments()
    {
        return $this->hasMany(ClassAssignment::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'class_assignments');
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
