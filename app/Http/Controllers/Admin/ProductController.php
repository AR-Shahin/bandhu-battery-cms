<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Helper\File\File;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Video;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{

    function index(Request $request)
    {
        if($request->ajax()){
            $query = Product::query()->with(["category","sub_category","brand"]);
            return $this->table($query)
                ->addIndexColumn()
                ->addColumn("actions",function($row){
                    $deleteRoute = route('admin.product.delete', $row["id"]);
                    $html = '<a class="btn btn-sm btn-success mr-1" href="'. route("admin.product.view",$row->id).'"><i class="fa fa-eye"></i></a>';
                    $html .= '<a class="btn btn-sm btn-info mr-1 mb-1" href="'. route("admin.product.edit",$row->id).'"><i class="fa fa-edit"></i></a>';

                    $html.= $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                    return $html;
                })
                ->addColumn("status", fn($row) => $row->status_badge)
                ->addColumn("image", fn($row) => '<img width="100px" src="' . asset($row["image"]) . '">')
                ->rawColumns(["actions","status","image"])
                ->make(true);
        }

        return view("admin.product.index");
    }

    function create()  {
        $categories = Category::whereHas("sub_categories")->get();
        $sub_categories = SubCategory::all();
        $brands = Brand::all();
        return view("admin.product.create",compact("categories","sub_categories","brands"));
    }

    function store(Request $request)  {

        $request->validate([
            "name" => ["required","unique:products"],
            "order" => ["required"],
            "model" => ["required"],
            "category_id" => ["required"],
            "sub_category_id" => ["required"],
            "brand_id" => ["required"],
            "image" => ["required"],
            "short_des" => ["required"],
            "description" => ["required"],
        ]);

        DB::transaction(function() use($request){
            try{
                $product = Product::create([
                    "name" => $request->name,
                    "slug" => bn_slug($request->name),
                    "order" => $request->order,
                    "short_des" => $request->short_des,
                    "description" => $request->description,
                    "model" => $request->model,
                    "brand_id" => $request->brand_id,
                    "sub_category_id" => $request->sub_category_id,
                    "category_id" => $request->category_id,
                    "status" => $request->status ?? false,
                    "image" => File::uploadYearMonthWise($request->file("image"),"product")
                ]);

                $videos = removeNullDataFromArray($request->video_ids);

                foreach($videos as $key=> $video){
                    $product->videos()->create([
                        "title" => $video_titles[$key] ?? "Default",
                        "order" => $video_orders[$key] ?? 0,
                        "video" => $video
                    ]);
                }

                if($request->images){
                    foreach($request->images as $key=> $image){
                        $product->images()->create([
                            "title" => $titles[$key] ?? "Default",
                            "order" => $orders[$key] ?? 0,
                            "image" => File::uploadYearMonthWise($image,"product/gallery")
                        ]);
                    }
                }
            }catch(Exception $e){
                dd($e->getMessage());
            }
        });
        $this->createdAlert();
        return redirect()->route("admin.product.index");
    }
    function delete(Product $product)  {
        $img = $product->image;
        $images = $product->images->pluck("image");

        $product->delete();
        $product->images()->delete();
        $product->videos()->delete();

        File::deleteFile($img);
        foreach($images as $image){
            File::deleteFile($image);
        }

        $this->deletedAlert();
        return back();
    }

    function edit(Product $product)  {
        $categories = Category::whereHas("sub_categories")->get();
        $sub_categories = SubCategory::all();
        $brands = Brand::all();
        return view("admin.product.edit",compact("product","brands","categories","sub_categories"));
    }

    function update(Product $product,Request $request)  {

        $request->validate([
            "name" => ["required","unique:products,name,$product->id"],
            "order" => ["required"],
            "model" => ["required"],
            "category_id" => ["required"],
            "sub_category_id" => ["required"],
            "brand_id" => ["required"],
            "short_des" => ["required"],
            "description" => ["required"],
        ]);
        DB::transaction(function() use($request,$product){
        try{
            $product->update([
                "name" => $request->name,
                "slug" => bn_slug($request->name),
                "order" => $request->order,
                "short_des" => $request->short_des,
                "description" => $request->description,
                "model" => $request->model,
                "brand_id" => $request->brand_id,
                "sub_category_id" => $request->sub_category_id,
                "category_id" => $request->category_id,
                "status" => $request->status ?? false,
            ]);

            if($request->has("image")){
                $img = $product->image;
                $product->update([
                    "image" => File::uploadYearMonthWise($request->file("image"),"product")
                ]);
                File::deleteFile($img);
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
        });



        $this->updatedAlert();
        return redirect()->back();
    }


    function view(Product $product)  {
        $product->load(["images","category","sub_category","brand","videos"]);
        return view("admin.product.view",compact("product"));
    }
    function photoGalleryUpdate(Image $image,Request $request)  {
        if($request->flag == "delete"){
            $img = $image->image;
            $image->delete();
            File::deleteFile($img);
            $this->deletedAlert();
            return back();
        }

        if($request->flag == "update"){
            $image->update([
                "title" => $request->title,
                "order" => $request->order,
            ]);
            if($request->has("image")){
                $img = $image->image;
                $image->update([
                    "image" => File::uploadYearMonthWise($request->image,"product/gallery")
                ]);
                File::deleteFile($img);
            }
            $this->updatedAlert();
            return back();
        }
    }
    function videoGalleryUpdate(Video $video,Request $request)  {
        if($request->flag == "delete"){
            $video->delete();
            $this->deletedAlert();
            return back();
        }

        if($request->flag == "update"){
            $video->update([
                "title" => $request->video_title,
                "order" => $request->video_order,
                "video" => $request->video_id
            ]);
            $this->updatedAlert();
            return back();
        }
    }


    function extraGalleryImageStore(Request $request,Product $product)  {
        try{
            if($request->images && count($request->images) > 0){
                foreach($request->images as $key=> $image){
                    $product->images()->create([
                        "title" => $titles[$key] ?? "Default",
                        "order" => $orders[$key] ?? 1,
                        "image" => File::uploadYearMonthWise($image,"product/gallery")
                    ]);
                }
            }
            $this->updatedAlert();
            return back();
        }catch(Exception $e){
            dd($e->getMessage());
        }

    }
}
