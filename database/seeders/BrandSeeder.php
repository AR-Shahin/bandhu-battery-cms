<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = array(
            "ABB",
            "Hyundai",
            "Schneider",
            "DONGA",
            "HIOKI",
            "FRAKO",
            "EPCOS",
            "OMRON",
            "RISESUN",
            "BRB CABLE",
            "RR CABLE",
            "LINDNER",
            "MIKRO",
            "SCHNIEDER",
            "DACO",
            "KUMANIKAL"
        );

        foreach($brands as $key => $brand){
            Brand::create([
                "name" => $brand,
                "slug" => str($brand)->slug(),
                "order" => $key + 1,
            ]);
        }
    }
}
