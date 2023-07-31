<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\Admin\BlogRequest;
use App\Services\Admin\BlogService;
use App\Traits\ImageUploadTrait;

class BlogController extends Controller
{
    use ImageUploadTrait;

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
        $validator = $request->validated();
         
        $data = $request->all();

        (new BlogService())->store($data, null);

        // Return success response
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get blog detail data
        $blog_item = Blog::findOrFail($id);
        
       // Return data to view
       return view('admin.edit.blog', compact('blog_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        // Validate sended datas
        $validator = $request->validated();
         
        $data = $request->all();

        (new BlogService())->store($data, $id);

        // Return success response
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        (new BlogService())->destroy($id);

        // Return succes response
        return redirect()->back();
    }
}
