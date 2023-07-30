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
        
        // Return data to view
        return view('admin.pages.blog', compact('blog_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        // Validate sended datas
        $validate = $request->validate();

        $data = $request->all();

        $this->BlogService()->store($data);

        // Return success response
        return response([
            'message' => 'Blog added successfully !'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get blog detail data
        $blog_detail = Blog::findOrFail($id);
        
        // Return data with Json
        return response()->json($blog_detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        // Validate sended datas
        $validator = $request->validate();
         
        $data = $request->all();

        $this->BlogService()->update($data);

        // Return success response
        return response([
            'message' => 'Blog updated successfully !'
        ]);
        
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
