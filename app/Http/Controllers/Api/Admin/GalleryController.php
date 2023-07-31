<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Http\Requests\Admin\GalleryRequest;
use App\Services\Admin\GalleryService;

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
       $validator = $request->validated();
         
       $data = $request->all();

       (new GalleryService())->store($data, null);

       // Return success response
       return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get gallery detail data
        $gallery_item = Gallery::findOrFail($id);
        
        // Return data to view
        return view('admin.edit.gallery', compact('gallery_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, string $id)
    {
        // Validate sended datas
        $validator = $request->validated();
         
        $data = $request->all();

        (new GalleryService())->store($data, $id);

        // Return success response
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        (new GalleryService())->destroy($id);

        // Return succes response
        return redirect()->back();
    }
}
