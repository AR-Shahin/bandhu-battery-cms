<?php


namespace App\Http\Controllers\Admin;

use App\Helper\File\File;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_front' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            Gallery::create([
                'image' => File::upload($image, 'galleries'),
                'is_front' => $request->is_front ?? false
            ]);
        }

        return back()->with('success', 'Gallery image added successfully');
    }

    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->is_front = $request->has('is_front') ? 1 : 0;
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery updated successfully!');
    }

    public function delete(Gallery $gallery)
    {
        $imge = $gallery->image;
        File::deleteFile($imge);

        $gallery->delete();
        return back()->with('success', 'Gallery deleted successfully');
    }
}
