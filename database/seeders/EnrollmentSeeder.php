<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroom = Classroom::first();
        $students = Student::all();

        foreach ($students as $student) {
            Enrollment::create([
                'student_id' => $student->id,
                'classroom_id' => $classroom->id,
            ]);
        }
    }
}
