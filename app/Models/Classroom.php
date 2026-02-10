<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'grade_id',
        'academic_year_id',
        'homeroom_teacher_id',
        'name',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id');
    }

    public function classAssignments()
    {
        return $this->hasMany(ClassAssignment::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_assignments');
    }

}
