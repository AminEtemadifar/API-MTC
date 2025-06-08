<?php

namespace Database\Seeders;

use App\Models\Chart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Read the JSON file
        $data = json_decode(file_get_contents(storage_path('data/charts.json')), true);

        // Insert each chart into the database
        foreach ($data as $chart) {
            Chart::create([
                'title' => $chart['title'],
                'sub_title' => $chart['sub_title'],
                'download_link' => $chart['download_link'],
                'study_field_id' => $chart['study_field_id'],
                'degree_level' => $chart['degree_level'],
            ]);
        }
    }
}
