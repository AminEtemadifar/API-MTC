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
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('123'),
            'role_type' => 'admin'
        ]);

        // Run seeders
        $this->call([
            StudyFieldSeeder::class,
            LessonSeeder::class,
            ChartSeeder::class,
            UserSeeder::class
        ]);
    }
}
