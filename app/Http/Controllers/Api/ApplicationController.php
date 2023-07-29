<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appliction;

class ApplicationController extends Controller
{
    // Application page show
    public function index(Request $request){
        // Get application data
        $application_items = Appliction::orderBy('id', 'desc')->get();

        // Return data with Json
        return response()->json($application_items);
    }

    // Application detail show
    public function show(Request $request, string $id){
        // Get application detail data
        $application_detail = Appliction::findOrFail($id);

        // Return data with Json
        return response()->json($application_detail);
    }
}
