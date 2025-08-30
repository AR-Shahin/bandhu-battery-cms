<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
    [
        "icon" => '<i class="fal fa-bolt"></i>',
        "title" => 'HIGH-QUALITY BATTERIES',
        "description" => "Power your devices with our premium range of batteries. From automotive to solar and home backup solutions, we provide long-lasting and reliable energy sources. Our batteries are designed to deliver high performance and durability, ensuring your devices run smoothly. Shop with confidence knowing you’re getting the best quality at the best price.",
    ],
    [
        "icon" => '<i class="fal fa-solar-panel"></i>',
        "title" => 'SOLAR ENERGY SOLUTIONS',
        "description" => "Switch to sustainable energy with our advanced solar panels and accessories. Whether you need a complete solar setup or just parts, we provide efficient and eco-friendly solutions to reduce your electricity bills. Invest in solar energy today and enjoy reliable power for years to come while contributing to a greener planet.",
    ],
    [
        "icon" => '<i class="fal fa-tv"></i>',
        "title" => 'LATEST ELECTRONIC GADGETS',
        "description" => "Stay updated with the latest electronics including smart TVs, home appliances, sound systems, and more. We bring you the newest technology at competitive prices to upgrade your lifestyle. Our products combine innovation, style, and performance for the perfect balance of convenience and entertainment.",
    ],
    [
        "icon" => '<i class="fal fa-tools"></i>',
        "title" => 'REPAIR & MAINTENANCE SERVICES',
        "description" => "We don’t just sell electronics—we also help you maintain them. Our expert technicians provide reliable repair and maintenance services for batteries, solar systems, and other electronic products. Get quick, professional support whenever you need it to keep your devices performing at their best.",
    ],
];


        foreach($services as $key => $service){
            Service::create([
                "icon" => $service["icon"],
                "slug" => str($service["title"])->slug(),
                "title" => $service["title"],
                "description" => $service["description"],
                "order" => $key + 1
            ]);
        }
    }
}
