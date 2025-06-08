<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $scheduleData = json_decode(file_get_contents(storage_path('data/class_schedule.json')), true);
        $instructors = [];

        foreach ($scheduleData as $schedule) {
            // Create instructor user if not exists
            if (!isset($instructors[$schedule['instructor_name']])) {
                $username = str_replace(' ', '_', $schedule['instructor_name']);
                $instructor = User::create([
                    'name' => $schedule['instructor_name'],
                    'username' => 'instructor' . rand(1,200),
                    'password' => Hash::make('123'),
                    'role_type' => 'instructor'
                ]);
                $instructors[$schedule['instructor_name']] = $instructor;
            }

            // Create lesson
            $lesson = Lesson::create([
                'code' => $schedule['id'],
                'course_offering_code' => $schedule['course_offering_code'],
                'title' => $schedule['title'],
                'offering_day' => $schedule['offering_day'],
                'offering_time' => $schedule['offering_time'],
                'classroom_number' => $schedule['classroom_number'],
                'exam_date' => $schedule['exam_date'],
                'instructor_id' => $instructors[$schedule['instructor_name']]->id
            ]);
        }
    }
} 