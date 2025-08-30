<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function index(Request $request) {
        if($request->ajax()){
            $query = Category::query();
            return $this->table($query)
                    ->addIndexColumn()
                    ->addColumn("actions",function($row){
                        $deleteRoute = route('admin.category.delete', $row["id"]);
                        $html = "";
                        $html .= $this->generateEditButton($row) .
                         $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                        return $html;
                    })
                    ->rawColumns(["actions"])
                    ->make(true);
        }
        return view("admin.category.index");
    }

    function store(Request $request) {

        $request->validate([
            "name" => ["required","unique:categories,name"],
            "order" => ["required","integer"],
        ]);
        Category::create([
            "name" => $request->name,
            "slug" => bn_slug($request->name),
            "order" => $request->order,
        ]);

        $this->logInfo("Category Created!");
        $this->successAlert("Category Created!");

        return back();
    }

    function delete(Category $category) {
        if(!$category->sub_categories()->exists())
        {
            $category->delete();
            $this->logInfo("Category Delete!");
            $this->successAlert("Category Delete!");
        }else{
            $this->warningAlert("Category Assigned in Subcategory!");
        }

        return redirect()->back();
    }
    function update(Request $request,Category $category) {

            $request->validate([
                "name" => ["required","unique:categories,name,$category->id"],
                "order" => ["required","integer"],
            ]);
            $category->update([
                "name" => $request->name,
                "slug" => bn_slug($request->name),
                "order" => $request->order,
            ]);

            $this->logInfo("Category Updated!");
            $this->successAlert("Category Updated!");

            return back();
        }
    private function generateEditButton($row){
        return '
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#rowId_'.$row['id'].'">
         <i class="fa fa-edit"></i>
        </button>
        <div class="modal fade" id="rowId_'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="rowId_'.$row['id'].'Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form action="'.route('admin.category.update',$row["slug"]).'" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="rowId_'.$row['id'].'Label">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value=" '. csrf_token() .'">
                <div class="form-group">
                    <label for=""><b>Name</b></label>
                    <input type="text" class="form-control" name="name" value="'. $row['name'].'">
                </div>
                <div class="form-group">
                <label for=""><b>Order</b></label>
                <input type="number" class="form-control" name="order" value="'. $row['order'].'">
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
          </form>
        </div>
      </div>';

    }
}
