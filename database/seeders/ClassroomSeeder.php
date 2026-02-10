<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = AcademicYear::first();
        $grade = Grade::first();
        $teacher = Teacher::first();

        Classroom::create([
            'grade_id' => $grade->id,
            'academic_year_id' => $year->id,
            'homeroom_teacher_id' => $teacher->id,
            'name' => '7-A',
        ]);
    }
}
