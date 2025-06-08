<?php

namespace Database\Seeders;

use App\Models\StudyField;
use Illuminate\Database\Seeder;

class StudyFieldSeeder extends Seeder
{
    public function run(): void
    {
        $branchData = json_decode(file_get_contents(storage_path('data/info_branch.json')), true);
        
        // Skip the first 3 elements as they are metadata
        $fields = array_slice($branchData[2]['data'], 3);
        
        foreach ($fields as $field) {
            StudyField::create([
                'id' => $field['CodeBrc'],
                'title' => $field['NameBrc'],
            ]);
        }
    }
} 