<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get blog data
        $blog_items = Blog::orderBy('id', 'desc')->get();
        
        // Return data with Json
        return response()->json($blog_items);
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
            'description_en' => 'required|string|max:16777215',
            'description_ru' => 'required|string|max:16777215',
            'description_hy' => 'required|string|max:16777215',
        ]);
         
        // Checking validated data
        if($validator->fails()) { // Has incorrect part
            // Return error response
            return response([
                'message' => 'Provided data is incorrect'
            ], 422);
        }else{ // All of correct
            // Make new blog data
            $new_blog = new BLog;
            $new_blog->title_en = $request->title_en;
            $new_blog->title_ru = $request->title_ru;
            $new_blog->title_hy = $request->title_hy;
            $new_blog->description_en = $request->description_en;
            $new_blog->description_ru = $request->description_ru;
            $new_blog->description_hy = $request->description_hy;
        
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
            }else{ // Has not a image
                // Add image filed before save data
                $new_blog->img = NULL;
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
            }else{ // Has not a file
                // Add file filed before save data
                $new_blog->file = NULL;
            }

            // Save data to DB
            $new_blog->save();

            // Return success response
            return response([
                'message' => 'Blog added successfully !'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get blog detail data
        $blog_detail = Blog::findOrFail($id);

        // Make empty data array
        $data = (object)[];

        // Push all page data to array
        $data->blog_detail = $blog_detail;
        
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
            'description_en' => 'required|string|max:16777215',
            'description_ru' => 'required|string|max:16777215',
            'description_hy' => 'required|string|max:16777215',
        ]);
         
        // Checking validated data
        if($validator->fails()) { // Has incorrect part
            // Return error response
            return response([
                'message' => 'Provided data is incorrect'
            ], 422);
        }else{ // All of correct
            // Make new blog data
            $new_blog = BLog::findOrFail($id);
            $new_blog->title_en = $request->title_en;
            $new_blog->title_ru = $request->title_ru;
            $new_blog->title_hy = $request->title_hy;
            $new_blog->description_en = $request->description_en;
            $new_blog->description_ru = $request->description_ru;
            $new_blog->description_hy = $request->description_hy;
        
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

            // Return success response
            return response([
                'message' => 'Blog updated successfully !'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find blog item
        $blog = Blog::findOrFail($id);

        // Get image path
        $image_path = 'assets/images/blog/'.$blog->img;

        // Check image file exists
        if(file_exists($image_path)) {
           // Destroy from storage
            unlink($image_path);
        }

        // Get file path
        $file_path = 'assets/files/blog/'.$blog->file;

        // Check file exists
        if(file_exists($file_path)) {
           // Destroy from storage
            unlink($file_path);
        }

        // Destroy blog item data
        $blog->delete();

        // Return succes response
        return response()->json([
            'message' => 'Blog item removed successfully'
        ]);
       
    }
}
