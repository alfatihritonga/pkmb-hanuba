<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guruUser = User::where('role', 'guru')->get();

        foreach ($guruUser as $index => $user) {
            Teacher::create([
                'user_id' => $user->id,
                'nip' => '19870' . $index,
                'name' => $user->name,
                'gender' => 'L',
                'phone' => '08' . rand(1000000000, 9999999999),
            ]);
        }
    }
}
