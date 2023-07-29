<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    // About page show
    public function index(){
        // Get about data
        $about = About::first();

        // Return data with Json
        return response()->json($about);
    }
}
