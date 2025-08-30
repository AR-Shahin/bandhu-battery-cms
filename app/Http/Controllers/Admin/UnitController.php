<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    function index(Request $request) {
        if($request->ajax()){
            $query = Unit::query();
            return $this->table($query)
                    ->addIndexColumn()
                    ->addColumn("actions",function($row){
                        $deleteRoute = route('admin.unit.delete', $row["id"]);
                        $html = "";
                        $html .= $this->generateEditButton($row) .
                         $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                        return $html;
                    })
                    ->rawColumns(["actions"])
                    ->make(true);
        }
        return view("admin.unit.index");
    }

    function store(Request $request) {
        $request->validate([
            "name_en" => ["required", "string", "max:255"],
            "name_bn" => ["required", "string", "max:255"],
        ]);
        
        Unit::create([
            "name_en" => $request->name_en,
            "name_bn" => $request->name_bn,
        ]);

        $this->logInfo("Unit Created!");
        $this->successAlert("Unit Created!");

        return back();
    }

    function delete(Unit $unit) {
        // Check if unit is being used (add your own logic here)
        // if(!$unit->products()->exists()) {
            $unit->delete();
            $this->logInfo("Unit Deleted!");
            $this->successAlert("Unit Deleted!");
        // } else {
        //     $this->warningAlert("Unit is assigned to products!");
        // }

        return redirect()->back();
    }

    function update(Request $request, Unit $unit) {
        $request->validate([
            "name_en" => ["required", "string", "max:255"],
            "name_bn" => ["required", "string", "max:255"],
        ]);
        
        $unit->update([
            "name_en" => $request->name_en,
            "name_bn" => $request->name_bn,
        ]);

        $this->logInfo("Unit Updated!");
        $this->successAlert("Unit Updated!");

        return back();
    }

    private function generateEditButton($row){
        return '
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#rowId_'.$row['id'].'">
         <i class="fa fa-edit"></i>
        </button>
        <div class="modal fade" id="rowId_'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="rowId_'.$row['id'].'Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form action="'.route('admin.unit.update',$row["id"]).'" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="rowId_'.$row['id'].'Label">Edit Unit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value=" '. csrf_token() .'">
                <div class="form-group">
                    <label for=""><b>Name (English)</b></label>
                    <input type="text" class="form-control" name="name_en" value="'.htmlspecialchars($row['name_en']).'" required>
                </div>
                <div class="form-group">
                    <label for=""><b>Name (Bengali)</b></label>
                    <input type="text" class="form-control" name="name_bn" value="'.htmlspecialchars($row['name_bn']).'" required>
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
