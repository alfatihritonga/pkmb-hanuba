<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id', 'nip', 'name', 'gender', 'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'homeroom_teacher_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
