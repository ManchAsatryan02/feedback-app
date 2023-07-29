<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    // Gallery page show
    public function index(Request $request){
        // Get gallery data
        $gallery_items = Gallery::orderBy('id', 'desc')->get();
        
        // Return data with Json
        return response()->json($gallery_items);
    }
}
