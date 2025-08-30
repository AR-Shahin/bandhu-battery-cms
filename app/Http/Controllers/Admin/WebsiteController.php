<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File\File;
use App\Http\Controllers\Controller;
use App\Models\WebsiteInfo;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    function index() {
        $data = WebsiteInfo::first();
        return view("admin.website.index",compact("data"));
    }

    function update(WebsiteInfo $data,Request $request)  {

        $data->update([
            "name" => $request->name,
            "title" => $request->title,
            "meta" => $request->meta,
            "tags" => $request->tags,
            "email" => $request->email,
            "phone" => $request->phone,
            "fb" => $request->fb,
            "youtube" => $request->youtube,
            "linkedin" => $request->linkedin,
            "address" => $request->address,
            "map" => $request->map,
        ]);

        if($request->file("logo")){
            $logo = $data->logo;
            $data->update([
                "logo" => File::upload($request->file("logo"),"generic")
            ]);
            File::deleteFile($logo);
        }

        $this->updatedAlert();
        return back();
    }
}
