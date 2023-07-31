<?php
namespace App\Services\Admin;
                    
use App\Models\Gallery;
use App\Traits\ImageUploadTrait;

class GalleryService
{
    use ImageUploadTrait;

    public function store($data, $id = null){
         // Check update or store
         if($id == null){ // Store
            // Make new gallery data
            $new_gallery = new Gallery;
        }else{ // Update
            // Make new gallery data
            $new_gallery = Gallery::findOrFail($id);
        }
        $new_gallery->title_en = $data['title_en'];
        $new_gallery->title_ru = $data['title_ru'];
        $new_gallery->title_hy = $data['title_hy'];
    
        // Check has request image or not
        if (isset($data['img'])) {
            // Uploading
            $filename = $this->handle($data['img'], 'gallery', 1, $new_gallery->img);

            // Add image filed before save data
            $new_gallery->img = $filename;
        }

        // Save data to DB
        $new_gallery->save();

        return true;
    }

    public function destroy($id){
        // Find gallery item
        $gallery = Gallery::findOrFail($id);

        // Unlink image
        $imagename = $this->unlinkFile($gallery->img, 'gallery');

        // Destroy gallery item data
        $gallery->delete();

        return true;
    }
    
}