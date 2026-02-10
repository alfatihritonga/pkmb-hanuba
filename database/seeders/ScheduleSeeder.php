<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroom = Classroom::first();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        foreach ($subjects as $index => $subject) {
            Schedule::create([
                'classroom_id' => $classroom->id,
                'subject_id' => $subject->id,
                'teacher_id' => $teachers[$index % $teachers->count()]->id,
                'day' => 'senin',
                'start_time' => '07:00',
                'end_time' => '08:30',
            ]);
        }
    }
}
