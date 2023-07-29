<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\About;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\User;

class HomeController extends Controller
{
    // Home page show
    public function index(Request $request){
        // Get slider data
        $slider_items = Slider::first();

        // Get about us data
        $about_us_data = About::first();

        // Get blog data
        $blog_items = Blog::orderBy('id', 'desc')->limit(3)->get();

        // Get gallery data
        $gallery_items = Gallery::orderBy('id', 'desc')->limit(12)->get();

        // Get partner data
        $partner_items = User::where('type', 1)->orderBy('id', 'desc')->get();
        
        // Return data with Json
        return response()->json([
            'slider_items' => $slider_items,
            'about_us_data' => $about_us_data,
            'blog_items' => $blog_items,
            'gallery_items' => $gallery_items,
            'partner_items' => $partner_items,
        ]);
    }
}
