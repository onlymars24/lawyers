<?php

namespace Database\Seeders;

use App\Data\Data;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = Setting::where('title', 'pages')->first();
        if($settings){
          $settings->delete();
        }
        $data = Data::$data;
          
          $settings = Setting::create([
            'title' => 'pages',
            'data' => $data
          ]);
    }
}
