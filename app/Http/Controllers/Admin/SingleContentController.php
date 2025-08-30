<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SingleContent;
use Illuminate\Http\Request;

class SingleContentController extends Controller
{
    function index() {
        $data = SingleContent::first();
        return view("admin.single_content.index",compact("data"));
    }

    function update(SingleContent $data,Request $request)  {
        $request->validate([
            "about" => ["required"],
            "mission" => ["required"],
            "goal" => ["required"],
            "vision" => ["required"],
        ]);
        $data->update([
            "about" => $request->about,
            "mission" => $request->mission,
            "goal" => $request->goal,
            "vision" => $request->vision,
        ]);

        $this->updatedAlert();
        return back();
    }

}
