<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = array(
            "VoltMaster CircuitForce",
            "ElectraPro",
            "PowerCore CircuitForce",
            "EnergizeX",
            "CircuitForce",
            "PowerGrid Plus CircuitForce",
            "IndustroVolt",
            "MegaAmp",
            "PowerFlow Systems",
            "CircuitShield",
            "IndustriFuse",
            "ElectraTech",
            "VoltEdge",
            "PowerScope",
            "ElectraLink"
        );
        $videos = ["9OaiRsZmxaM","DZf1x7oqQXs","lDmeeqIfdIg"];
        foreach($products as $key => $product){
            $cat = Category::whereHas("sub_categories")->inRandomOrder()->first();
            $brand = Brand::inRandomOrder()->first();
            $data = $cat->sub_categories()->get();
            $product = Product::create([
                "category_id" => $cat->id,
                "brand_id" => $brand->id,
                "sub_category_id" => $data->random()->id,
                "name" => $product,
                "slug" => str($product)->slug(),
                "order" => $key + 1,
                "model" => $product . $key ,
                "image" => "storage/generic/product.jpeg",
                "short_des" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit amet consectetur adipisicing elit"
            ]);
            foreach($videos as $key=> $video){
                $product->videos()->create([
                    "title" => "Default",
                    "order" => $key + 1,
                    "video" => $video
                ]);
            }
            for($j = 1;$j<=5;$j++){
                $product->images()->create([
                    "title" => "Default",
                    "order" => $j,
                    "image" => "storage/generic/product_1.jpeg"
                ]);
            }
        }

    }
}
