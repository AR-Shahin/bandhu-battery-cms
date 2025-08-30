<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Electrical Components",
            "Power Distribution",
            "Circuit Protection",
            "Automation Systems",
            "Control Systems",
            "Cable and Wiring",
            "Switchgear",
            "Industrial Electronics",
            "Sensors and Actuators",
            "Electrical Testing Equipment",
            "Power Conversion",
            "Motor Control",
            "Transformers",
            "Industrial Lighting",
            "Energy Management"
        ];

        foreach($categories as $key => $category){
            Category::create([
                "name" => $category,
                "slug" => str($category)->slug(),
                "order" => $key + 1,
            ]);
        }
    }
}


