<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            Student::create([
                'nis' => '2025' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nisn' => '00999' . rand(100000, 999999),
                'name' => 'Siswa ' . $i,
                'gender' => $i % 2 == 0 ? 'L' : 'P',
                'birth_date' => now()->subYears(13),
                'address' => 'Alamat siswa ' . $i,
            ]);
        }
    }
}
