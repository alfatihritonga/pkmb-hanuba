<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $subjects = Subject::all();
        $classroom = Classroom::first();

        foreach ($students as $student) {
            foreach ($subjects as $subject) {
                Score::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'classroom_id' => $classroom->id,
                    'semester' => 'ganjil',
                    'type' => 'uts',
                    'score' => rand(70, 95),
                ]);
            }
        }
    }
}
