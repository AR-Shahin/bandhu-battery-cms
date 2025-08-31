<?php

namespace Database\Seeders;

use App\Models\SingleContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SingleContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       SingleContent::create([
            "about" => "Our mission at Bandhu Battery is to fight against energy insecurity by providing reliable, long-lasting, and eco-friendly power solutions. We are committed to delivering high-quality batteries and related energy products while promoting awareness about sustainable energy practices. Through community engagement and trusted partnerships, we aim to build a dependable power network that supports growth, innovation, and a brighter future for everyone. By addressing the core challenges of energy reliability, we strive to create a lasting positive impact and inspire others to join our cause.",

            "mission" => "Our mission is to ensure that every household, business, and community has access to dependable and sustainable power solutions. We envision a world where no one faces disruption due to lack of energy, and everyone can live and work with the confidence of uninterrupted power. Our focus is to strengthen energy security while raising awareness about the importance of green and sustainable energy practices. With collective efforts, we aim to eliminate energy challenges and build a more empowered and resilient society.",

            "vision" => "Our vision is to make power security a reality for all by providing high-quality batteries and renewable energy solutions. We aspire to build a society where every individual, family, and business has access to affordable and sustainable energy. To achieve this, we continuously innovate, support community initiatives, and collaborate with partners and donors who share our vision. We believe in creating a future powered by sustainability and trust.",

            "goal" => "Our goal is to guarantee reliable access to energy and promote sustainable living through eco-friendly battery solutions. We want to empower every household and business with uninterrupted power, ensuring stability, progress, and growth. By implementing various service projects and working hand in hand with partners and supporters, we remain dedicated to building a strong, energy-secure society.",
        ]);
    }
}
