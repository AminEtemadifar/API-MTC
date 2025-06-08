<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample students
        $students = [
            [
                'name' => 'Student One',
                'username' => 'student1',
                'password' => '123',
                'national_code' => '1234567890',
                'role_type' => 'student',
            ],
            [
                'name' => 'Student Two',
                'username' => 'student2',
                'password' => '123',
                'national_code' => '2345678901',
                'role_type' => 'student',
            ],
            [
                'name' => 'Student Three',
                'username' => 'student3',
                'password' => '123',
                'national_code' => '3456789012',
                'role_type' => 'student',
            ],
        ];

        // Create students and associate them with lessons
        foreach ($students as $studentData) {
            $student = User::create([
                'name' => $studentData['name'],
                'username' => $studentData['username'],
                'password' => Hash::make($studentData['password']),
                'national_code' => $studentData['national_code'],
                'role_type' => $studentData['role_type'],
            ]);

            // Get random lessons and associate them with the student
            $lessons = Lesson::inRandomOrder()->take(rand(7,10))->get();
            $student->lessons()->attach($lessons);
        }
    }
} 