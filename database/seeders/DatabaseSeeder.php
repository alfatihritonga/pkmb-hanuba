<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@gmail.com',
        // ]);

        $this->call([
            // UserSeeder::class,
            // AcademicYearSeeder::class,
            // GradeSeeder::class,
            SubjectSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            // ClassroomSeeder::class,
            // EnrollmentSeeder::class,
            // ScheduleSeeder::class,
            // ScoreSeeder::class,
        ]);
    }
}
