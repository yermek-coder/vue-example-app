<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = database_path('seeders/data/property_data.csv');
        $csvData = array_map('str_getcsv', file($csvFile));
        
        // Remove headers
        array_shift($csvData);
        
        foreach ($csvData as $row) {
            DB::table('properties')->insert([
                'name' => $row[0],
                'price' => (int) $row[1],
                'bedrooms' => (int) $row[2],
                'bathrooms' => (int) $row[3],
                'storeys' => (int) $row[4],
                'garages' => (int) $row[5],
            ]);
        }
    }
}