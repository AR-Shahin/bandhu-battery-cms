<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File\File;
use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    function index(Category $category, Request $request) {
        $categories = $category->get("id","name");
        if($request->ajax()){
            $categories = SubCategory::query()->with("category");
            return $this->table($categories)

            ->addColumn("actions",function($row) use($categories){
                $deleteRoute = route('admin.sub-category.delete', $row["id"]);
                $html = $this->generateEditButton($row,$categories) .
                $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                return $html;
            })
            ->rawColumns(["actions"])
            ->make(true);
        }

        return view("admin.sub_category.index",compact("categories"));
    }

    function store(Request $request) {

        $request->validate([
            "name" => ["required"],
            "order" => ["required","integer"],
            "category_id" => ["required","integer"],
        ]);
        SubCategory::create([
            "name" => $request->name,
            "slug" => bn_slug($request->name),
            "order" => $request->order,
            "category_id" => $request->category_id,
        ]);

        $this->logInfo("Category Created!");
        $this->successAlert("Category Created!");

        return redirect()->back();
    }

    function delete(SubCategory $category) {

        if(!$category->products()->exists())
        {
            $category->delete();
            $this->logInfo("Category Delete!");
            $this->successAlert("Category Delete!");
        }else{
            $this->warningAlert("category Assigned in District!");
        }

        return redirect()->back();
    }
    function update(Request $request,SubCategory $category) {
        $request->validate([
            "name" => ["required","unique:categories,name,$category->id"],
            "order" => ["required","integer"],
        ]);

        return $category;
        $category->update([
            "name" => $request->name,
            "slug" => bn_slug($request->name),
            "order" => $request->order,
        ]);

        $this->logInfo("Category Updated!");
        $this->successAlert("Category Updated!");

        return view("admin.category.index");
    }



    private function generateEditButton($row,$types){

        $html = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#rowId_' . $row['id'] . '">
        <i class="fa fa-edit"></i>
    </button>
    <div class="modal fade" id="rowId_' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="rowId_' . $row['id'] . 'Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="' . route('admin.sub-category.update', $row["id"]) . '" method="post">
                <div class="modal-content text-left">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rowId_' . $row['id'] . 'Label">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <div class="form-group">
                            <label for=""><b>Name</b></label>
                            <input type="text" class="form-control" name="name" value="' . $row['name'] . '">
                        </div>
                        <label for=""><b>Category</b></label>
                        <select class="form-control" name="category_id" id="type">';

                        foreach ($types as $type) {
                            $html .= '<option value="' . $type->id . '" ' . ($type->id == $row->category_id ? 'selected' : '') . '>' . $type->name . '</option>';
                        }

                    $html .= '</select>
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

    return $html;
    }

}
