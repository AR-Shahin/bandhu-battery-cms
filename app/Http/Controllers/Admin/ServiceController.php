<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function index(Request $request)
    {
        if($request->ajax()){
            $query = Service::query();
            return $this->table($query)
                ->addIndexColumn()
                ->addColumn("actions",function($row){
                    $deleteRoute = route('admin.services.delete', $row["id"]);
                    $html = '<a class="btn btn-sm btn-info mr-1 mb-1" href="'. route("admin.services.edit",$row->id).'"><i class="fa fa-edit"></i></a>';

                    $html.= $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                    return $html;
                })
                ->addColumn("status", fn($row) => $row->status_badge)
                ->addColumn("icon", fn($row) => $row->icon)
                ->addColumn("description", fn($row) => $row->description)
                ->rawColumns(["actions","status","icon","description"])
                ->make(true);
        }

        return view("admin.service.index");
    }

    function create()  {
        return view("admin.service.create");
    }

    function store(Request $request)  {
        $request->validate([
            "title" => ["required","unique:services"],
            "order" => ["required"],
            "icon" => ["required"],
            "description" => ["required"],
        ]);

        Service::create([
            "title" => $request->title,
            "slug" => bn_slug($request->title),
            "order" => $request->order,
            "description" => $request->description,
            "icon" => $request->icon,
            "status" => $request->status ?? false,
        ]);

        $this->createdAlert();
        return redirect()->route("admin.services.index");
    }
    function delete(Service $service)  {
        $service->delete();

        $this->successAlert("Deleted!");
        return back();
    }

    function edit(Service $service)  {
        return view("admin.service.edit",compact("service"));
    }

    function update(Service $service,Request $request)  {
        $request->validate([
            "title" => ["required","unique:services,title,$service->id"],
            "order" => ["required"],
            "icon" => ["required"],
            "description" => ["required"],
        ]);
        $service->update([
            "title" => $request->title,
            "slug" => bn_slug($request->title),
            "order" => $request->order,
            "description" => $request->description,
            "icon" => $request->icon,
            "status" => $request->status ?? false,
        ]);

        $this->updatedAlert();
        return redirect()->route("admin.services.index");
    }

}
