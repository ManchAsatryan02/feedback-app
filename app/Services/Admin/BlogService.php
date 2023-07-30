<?php
namespace App\Services\Admin;
                    
use App\Models\Blog;

class BlogService
{
    public function store($data)
    {
        // Make new blog data
        $new_blog = new BLog;
        $new_blog->title_en = $data['title_en'];
        $new_blog->title_ru = $data['title_ru'];
        $new_blog->title_hy = $data['title_hy'];
        $new_blog->description_en = $data['description_en'];
        $new_blog->description_ru = $data['description_ru'];
        $new_blog->description_hy = $data['description_hy'];
    
        // Check has request image or not
        if ($data->hasFile('img')) { // Has a image
            // Get image file
            $image = $data->file('img');

            // Make image new name
            $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Get path
            $image_path = 'assets/images/blog/' . $filename;

            // Save the image to a specific path
            $image->save($image_path);

            // Add image filed before save data
            $new_blog->img = $filename;
        }else{ // Has not a image
            // Add image filed before save data
            $new_blog->img = NULL;
        }

        // Check has request file or not
        if ($data->hasFile('file')) { // Has a file
            // Get file file
            $file = $data->file('file');

            // Make file new name
            $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Get path
            $file_path = 'assets/files/blog/' . $filename;

            // Save the file to a specific path
            $file->save($file_path);

            // Add file filed before save data
            $new_blog->file = $filename;
        }else{ // Has not a file
            // Add file filed before save data
            $new_blog->file = NULL;
        }

        // Save data to DB
        $new_blog->save();

        return true;
    }

    public function update($data){
        // Make new blog data
        $new_blog = BLog::findOrFail($id);
        $new_blog->title_en = $data['title_en'];
        $new_blog->title_ru = $data['title_ru'];
        $new_blog->title_hy = $data['title_hy'];
        $new_blog->description_en = $data['description_en'];
        $new_blog->description_ru = $data['description_ru'];
        $new_blog->description_hy = $data['description_hy'];
    
        // Check has request image or not
        if ($request->hasFile('img')) { // Has a image
            // Get image file
            $image = $request->file('img');

            // Make image new name
            $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Get path
            $image_path = 'assets/images/blog/' . $filename;

            // Save the image to a specific path
            $image->save($image_path);

            // Add image filed before save data
            $new_blog->img = $filename;

            // Get old image path
            $old_image_path = 'assets/images/blog/'.$image;

            // Check image file exists
            if(file_exists($old_image_path)) {
                // Destroy from storage
                unlink($old_image_path);
            }
        }

        // Check has request file or not
        if ($request->hasFile('file')) { // Has a file
            // Get file file
            $file = $request->file('file');

            // Make file new name
            $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Get path
            $file_path = 'assets/files/blog/' . $filename;

            // Save the file to a specific path
            $file->save($file_path);

            // Add file filed before save data
            $new_blog->file = $filename;
        
            // Get old file path
            $old_file_path = 'assets/files/blog/'.$file;

            // Check file file exists
            if(file_exists($old_file_path)) {
                // Destroy from storage
                unlink($old_file_path);
            }
        }

        // Save data to DB
        $new_blog->save();

        return true;
    }
    
}