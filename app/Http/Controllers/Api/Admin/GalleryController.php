<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Requests\GalleryRequest;
use App\Service\GalleryService;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get gallery data
        $gallery_items = Gallery::orderBy('id', 'desc')->get();

        // Return data to view
        return view('admin.pages.gallery', compact('gallery_items'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        // Validate sended datas
        $validate = $request->validate();
         
        $data = $request->all();

        $this->GalleryService()->store($data);

        // Return success response
        return response([
            'message' => 'Gallery added successfully !'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get gallery detail data
        $gallery_detail = Gallery::findOrFail($id);
        
        // Return data with Json
        return response()->json($gallery_detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, string $id)
    {
        // Validate sended datas
        $validate = $request->validate();
         
        $data = $request->all();

        $this->GalleryService()->update($data);

        // Return success response
        return response([
            'message' => 'Gallery updated successfully !'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find gallery items
        $gallery = Gallery::findOrFail($id);

        // Get image path
        $image_path = 'assets/images/gallery/'.$gallery->img;

        // Check image file exists
        if(file_exists($image_path)) {
           // Destroy from storage
            unlink($image_path);
        }

        // Destroy gallery item data
        $gallery->delete();

        // Return succes response
        return response()->json([
            'message' => 'Gallery item removed successfully'
        ]);
    }
}
