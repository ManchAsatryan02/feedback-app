<?php
namespace App\Services\Admin;
                    
use App\Models\Gallery;

class GalleryService
{
        
    public function store($data)
    {
        // Make new gallery data
        $new_gallery = new Gallery;
        $new_gallery->title_en = $data['title_en'];
        $new_gallery->title_ru = $data['title_ru'];
        $new_gallery->title_hy = $data['title_hy'];
    
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

        return true;
    }

    public function update($data){
        // Make new gallery data
        $new_gallery = Gallery::findOrFail($id);
        $new_gallery->title_en = $request['title_en'];
        $new_gallery->title_ru = $request['title_ru'];
        $new_gallery->title_hy = $request['title_hy'];
    
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

        return true;
    }
    
}