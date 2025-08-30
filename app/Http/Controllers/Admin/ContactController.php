<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File\File;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function index(Request $request)
    {
        if($request->ajax()){
            $query = Contact::query()->latest();
            return $this->table($query)
                ->addIndexColumn()
                ->addColumn("actions",function($row){
                    $deleteRoute = route('admin.contacts.delete', $row["id"]);
                    $html = '';
                    if(!$row->status){
                        $html .= '<a class="btn btn-sm btn-success mr-1 mb-1 " href="'. route("admin.contacts.update",$row->id).'"><i class="fa fa-arrow-up"></i></a>';
                    }
                    $html.= $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                    return $html;
                })

                ->addColumn("status", fn($row) => $row->status_contact)
                ->addColumn("image", fn($row) => '<img width="100px" src="' . asset($row["image"]) . '">')
                ->rawColumns(["actions","status","image"])
                ->make(true);
        }

        return view("admin.contact.index");
    }



    function delete(Contact $contact)  {
        $img = $contact->image;
        $contact->delete();
        File::deleteFile($img);
        $this->successAlert("Deleted!");
        return back();
    }


    function update(Contact $contact)  {

       $contact->update([
        "status" => true
       ]);
        $this->successAlert("Updated!");
        return back();
    }

}