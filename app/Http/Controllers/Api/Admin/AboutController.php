<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Services\Admin\AboutService;
use App\Http\Requests\Admin\AboutRequest;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get about data
        $about_item = About::first();

        // Return data to view
        return view('admin.pages.about', compact('about_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request)
    {
        // Validate sended datas
        $validate = $request->validated();

        $data = $request->all();
        
       (new AboutService)->handle($data);
         
        // Return success response
        return redirect()->back();
    }
}
