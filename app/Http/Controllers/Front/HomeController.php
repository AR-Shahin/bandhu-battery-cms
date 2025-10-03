<?php

namespace App\Http\Controllers\Front;

use App\Models\Team;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Service;
use App\Models\Activity;
use App\Helper\File\File;
use Illuminate\Http\Request;
use App\Models\SingleContent;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function index()  {
        $services = Service::active()->take(3)->get();
        $single = SingleContent::first();
        $products = Product::active()->take(4)->get();
        $galleries = Gallery::isFront()->latest()->take(12)->get();
        return view("home",compact("services","single","products","galleries"));
    }

    function about()  {

        $data = SingleContent::first();
        return view("front.about",compact("data"));
    }

    function services()  {
        $services = Service::active()->get();
        return view("front.service",compact("services",));
    }

    function contact()  {
        return view("front.contact");
    }

    function contactStore(Request $request)  {

        $request->validate([
            "name" => ["required"],
            "email" => ["required"],
            "subject" => ["required"],
            "phone" => ["required"],
            "message" => ["required"],
        ]);

        $c = Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "phone" => $request->phone,
            "message" => $request->message,
        ]);

        if($request->file("image")){
            $c->update(["image" => File::upload($request->file("image"),"generic/contact")]);
        }

        return back()->with("success","Thanks for message us!");
    }

    function single(Activity $activity) {
        $activity->load(["images" => fn($q) => $q->orderBy("order"),"videos" => fn($q) => $q->orderBy("order")]);
        return view("front.single_activity",compact("activity"));
    }

    function page($type)  {
        $types = ["finance","project","blog"];

       abort_if(!in_array($type,$types),404);

       return view("front.page",compact("activities","type"));
    }

    function teams()  {
        $teams = Team::active()->paginate(12);
       return view("front.team",compact("teams"));
    }

}
