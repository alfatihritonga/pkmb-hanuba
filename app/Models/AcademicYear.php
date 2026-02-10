<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'year',
        'is_active'
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

}
