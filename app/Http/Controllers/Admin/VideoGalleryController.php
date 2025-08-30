<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoGalleryController extends Controller
{
    public function index(Request $request) 
    {
        if($request->ajax()){
            $query = VideoGallery::query()->orderBy('id', 'desc');
            return $this->table($query)
                    ->addIndexColumn()
                    ->addColumn("status", function($row){
                        $status = $row["status"] == 'active' ? 'success' : 'danger';
                        return "<span class='badge badge-{$status}'>{$row['status']}</span>";
                    })
                    ->addColumn("is_front", function($row){
                        return $row["is_front"] ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>';
                    })
                    ->addColumn("thumbnail", function($row){
                        $thumbnail = $row["thumb"] ?: "https://img.youtube.com/vi/{$row['video_id']}/maxresdefault.jpg";
                        return "<img src='{$thumbnail}' alt='Thumbnail' style='width: 60px; height: 40px; object-fit: cover;'>";
                    })
                    ->addColumn("actions",function($row){
                        $deleteRoute = route('admin.video-gallery.delete', $row["id"]);
                        $html = "";
                        $html .= $this->generateEditButton($row) .
                         $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                        return $html;
                    })
                    ->rawColumns(["actions", "status", "is_front", "thumbnail"])
                    ->editColumn('title', function($row) {
                        return htmlspecialchars($row['title']);
                    })
                    ->editColumn('video_id', function($row) {
                        return htmlspecialchars($row['video_id']);
                    })
                    ->make(true);
        }
        return view("admin.video_gallery.index");
    }

    public function store(Request $request) 
    {
        $request->validate([
            "title" => ["required", "string", "max:255"],
            "video_id" => ["required", "string", "max:255"],
            "thumb" => ["nullable", "url"],
            "status" => ["required", "in:active,inactive"],
            "is_front" => ["boolean"],
        ]);

        VideoGallery::create([
            "title" => $request->title,
            "video_id" => $request->video_id,
            "thumb" => $request->thumb,
            "status" => $request->status,
            "is_front" => $request->has('is_front'),
        ]);

        $this->logInfo("Video Gallery Created!");
        $this->successAlert("Video Gallery Created!");

        return back();
    }

    public function delete(VideoGallery $videoGallery) 
    {
        $videoGallery->delete();
        $this->logInfo("Video Gallery Deleted!");
        $this->successAlert("Video Gallery Deleted!");

        return redirect()->back();
    }

    public function update(Request $request, VideoGallery $videoGallery) 
    {
        $request->validate([
            "title" => ["required", "string", "max:255"],
            "video_id" => ["required", "string", "max:255"],
            "thumb" => ["nullable", "url"],
            "status" => ["required", "in:active,inactive"],
        ]);

        $videoGallery->update([
            "title" => $request->title,
            "video_id" => $request->video_id,
            "thumb" => $request->thumb,
            "status" => $request->status,
            "is_front" => $request->has('is_front') ? 1 : 0,
        ]);

        $this->logInfo("Video Gallery Updated!");
        $this->successAlert("Video Gallery Updated!");

        return back();
    }

    private function generateEditButton($row)
    {
        $checked = $row['is_front'] ? 'checked' : '';
        $thumbValue = $row['thumb'] ?? '';
        return '
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#rowId_'.$row['id'].'">
         <i class="fa fa-edit"></i>
        </button>
        <div class="modal fade" id="rowId_'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="rowId_'.$row['id'].'Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form action="'.route('admin.video-gallery.update',$row["id"]).'" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="rowId_'.$row['id'].'Label">Edit Video</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="'. csrf_token() .'">
                <div class="form-group">
                    <label for=""><b>Title</b></label>
                    <input type="text" class="form-control" name="title" value="'.htmlspecialchars($row['title']).'" required>
                </div>
                <div class="form-group">
                    <label for=""><b>YouTube Video ID</b></label>
                    <input type="text" class="form-control" name="video_id" value="'.htmlspecialchars($row['video_id']).'" required>
                    <small class="text-muted">Enter the YouTube video ID (e.g., dQw4w9WgXcQ from https://www.youtube.com/watch?v=dQw4w9WgXcQ)</small>
                </div>
                <div class="form-group">
                    <label for=""><b>Custom Thumbnail URL (Optional)</b></label>
                    <input type="url" class="form-control" name="thumb" value="'.htmlspecialchars($thumbValue).'">
                    <small class="text-muted">Leave blank to use YouTube auto-generated thumbnail</small>
                </div>
                <div class="form-group">
                    <label for=""><b>Status</b></label>
                    <select name="status" class="form-control" required>
                        <option value="active" '.($row['status'] == 'active' ? 'selected' : '').'>Active</option>
                        <option value="inactive" '.($row['status'] == 'inactive' ? 'selected' : '').'>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_front" id="is_front_'.$row['id'].'" '.$checked.'>
                        <label class="form-check-label" for="is_front_'.$row['id'].'">
                            Show on Frontend
                        </label>
                    </div>
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
