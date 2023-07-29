<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    // Blog page show
    public function index(Request $request){
        // Get blog data
        $blog_items = Blog::orderBy('id', 'desc')->get();

        // Return data with Json
        return response()->json($blog_items);
    }

    // Blog detail show
    public function show(Request $request, string $id){
        // Get blog detail data
        $blog_detail = Blog::findOrFail($id);

        // Return data with Json
        return response()->json($blog_detail);
    }
}
