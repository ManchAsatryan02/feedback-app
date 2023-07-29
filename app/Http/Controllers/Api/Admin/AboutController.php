<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Requets\Admin\AboutRequest;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get about data
        $about_data = About::first();

        // Return data with Json
        return response()->json($about_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request)
    {
        // Validate sended datas
        $validate = $request->validate();

        $data = $request->all();
        
        $this->AboutRequest()->handle($data);
         
        // Return success response
        return response()->json([
            'status' => true
        ]);
    }
}
