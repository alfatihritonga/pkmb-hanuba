<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassAssignment extends Model
{
    protected $fillable = [
        'student_id',
        'classroom_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
