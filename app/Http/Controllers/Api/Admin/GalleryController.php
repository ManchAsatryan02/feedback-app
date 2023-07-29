<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get gallery data
        $gallery_items = Gallery::orderBy('id', 'desc')->get();

        // Return data with Json
        return response()->json($gallery_items);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate sended datas
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|string|max:50',
            'title_ru' => 'required|string|max:50',
            'title_hy' => 'required|string|max:50',
        ]);
         
        // Checking validated data
        if($validator->fails()) { // Has incorrect part
            // Return error response
            return response([
                'message' => 'Provided data is incorrect'
            ], 422);
        }else{ // All of correct
            // Make new gallery data
            $new_gallery = new Gallery;
            $new_gallery->title_en = $request->title_en;
            $new_gallery->title_ru = $request->title_ru;
            $new_gallery->title_hy = $request->title_hy;
        
            // Check has request image or not
            if ($request->hasFile('img')) { // Has a image
                // Get image file
                $image = $request->file('img');
    
                // Make image new name
                $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();

                // Get path
                $image_path = 'assets/images/gallery/' . $filename;

                // Save the image to a specific path
                $image->save($image_path);

                // Add image filed before save data
                $new_gallery->img = $filename;
            }else{ // Has not a image
                // Add image filed before save data
                $new_gallery->img = NULL;
            }

            // Save data to DB
            $new_gallery->save();

            // Return success response
            return response([
                'message' => 'Gallery added successfully !'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get gallery detail data
        $gallery_detail = Gallery::findOrFail($id);

        // Make empty data array
        $data = (object)[];

        // Push all page data to array
        $data->gallery_detail = $gallery_detail;
        
        // Return data with Json
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate sended datas
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|string|max:50',
            'title_ru' => 'required|string|max:50',
            'title_hy' => 'required|string|max:50',
        ]);
         
        // Checking validated data
        if($validator->fails()) { // Has incorrect part
            // Return error response
            return response([
                'message' => 'Provided data is incorrect'
            ], 422);
        }else{ // All of correct
            // Make new gallery data
            $new_gallery = Gallery::findOrFail($id);
            $new_gallery->title_en = $request->title_en;
            $new_gallery->title_ru = $request->title_ru;
            $new_gallery->title_hy = $request->title_hy;
        
            // Check has request image or not
            if ($request->hasFile('img')) { // Has a image
                // Get image file
                $image = $request->file('img');
    
                // Make image new name
                $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();

                // Get path
                $image_path = 'assets/images/gallery/' . $filename;

                // Save the image to a specific path
                $image->save($image_path);

                // Add image filed before save data
                $new_gallery->img = $filename;

                // Get image path
                $old_image_path = 'assets/images/gallery/'.$filename;

                // Check image file exists
                if(file_exists($old_image_path)) {
                    // Destroy from storage
                    unlink($old_image_path);
                }
            }

            // Save data to DB
            $new_gallery->save();

            // Return success response
            return response([
                'message' => 'Gallery updated successfully !'
            ]);
        }
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
