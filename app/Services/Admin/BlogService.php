<?php

namespace App\Services\Admin;
                    
use App\Models\Blog;
use App\Traits\ImageUploadTrait;

class BlogService
{
    use ImageUploadTrait;

    public function store($data, $id = null){
        // Check update or store
        if($id == null){ // Store
            // Make new blog data
            $new_blog = new BLog;
        }else{ // Update
            // Make new blog data
            $new_blog = BLog::findOrFail($id);
        }
        
        $new_blog->title_en = $data['title_en'];
        $new_blog->title_ru = $data['title_ru'];
        $new_blog->title_hy = $data['title_hy'];
        $new_blog->description_en = $data['description_en'];
        $new_blog->description_ru = $data['description_ru'];
        $new_blog->description_hy = $data['description_hy'];
    
        // Check has request image or not
        if (isset($data['img'])) {
            // Uploading
            $filename = $this->handle($data['img'], 'blog', 1, $new_blog->img);

            // Add image filed before save data
            $new_blog->img = $filename;
        }

        // Check has request file or not
        if (isset($data['file'])) {
            // Uploading
            $filename = $this->handleFile($data['file'], 'blog/files', $new_blog->file);

            // Add file filed before save data
            $new_blog->file = $filename;
        }

        // Save data to DB
        $new_blog->save();

        return true;
    }

    public function destroy($id){
        // Find blog item
        $blog = Blog::findOrFail($id);

        // Unlink image
        $imagename = $this->unlinkFile($blog->img, 'blog');

        // Unlink file
        $filename = $this->unlinkFile($blog->file, 'blog/files');

        // Destroy blog item data
        $blog->delete();

        return true;
    }
    
}