<?php

namespace App\Http\Controllers\Front;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    function index(Request $request) {
        // Start with the active products query
        $productsQuery = Product::active();


        $filters = [
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'brand_id' => $request->brand,
        ];

        // Apply filters based on the request input
        foreach ($filters as $field => $value) {
            if ($value) {
                $productsQuery->where($field, $value);
            }
        }

        // Apply the search_key condition if provided
        if ($request->filled('search_key')) {
            $productsQuery->where('name', 'LIKE', $request->search_key . '%');
        }

        // Paginate the results with 20 items per page
        $products = $productsQuery->paginate(20);

        // Retrieve all categories, subcategories, and brands
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();

        // Return the view with the data
        return view('front.product', [
            'products' => $products,
            'categories' => $categories,
            'sub_categories' => $subCategories,
            'brands' => $brands,
        ]);
    }

    function product(Product $product)  {
        $product->load(["images","category","sub_category","brand","videos"]);
        return view('front.single',compact("product"));
    }
}
