<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
            // Subcategories for Electrical Components
            "Resistors",
            "Capacitors",
            "Inductors",
            "Relays",
            "Connectors",

            // Subcategories for Power Distribution
            "Circuit Breakers",
            "Distribution Panels",
            "Load Centers",
            "Transformers",
            "Switchgear",

            // Subcategories for Circuit Protection
            "Fuses",
            "Surge Protectors",
            "Ground Fault Interrupters (GFI)",
            "Circuit Breaker Panels",

            // Subcategories for Automation Systems
            "Programmable Logic Controllers (PLC)",
            "Human-Machine Interfaces (HMI)",
            "Industrial Robotics",
            "Automation Software",
            "SCADA Systems",

            // Subcategories for Control Systems
            "Motor Drives",
            "Servo Controllers",
            "PID Controllers",
            "Sensors",

            // Subcategories for Cable and Wiring
            "Power Cables",
            "Control Cables",
            "Data Cables",
            "Wiring Accessories",
            "Conduits",

            // Subcategories for Industrial Electronics
            "Power Supplies",
            "Inverters",
            "Rectifiers",
            "Sensors",
            "Transducers"
        );

        foreach($categories as $key => $category){
            SubCategory::create([
                "category_id" =>rand(1,4),
                "name" => $category,
                "slug" => str($category)->slug(),
                "order" => $key + 1,
            ]);
        }
    }
}
