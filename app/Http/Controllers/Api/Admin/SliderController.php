<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\Admin\SliderRequest;
use App\Services\Admin\SliderService;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get slider data
        $slider_item = Slider::first();

        // Return data to view
        return view('admin.pages.slider', compact('slider_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request)
    {
        // Validate sended datas
        $validate = $request->validated();
         
        $data = $request->all();

        (new SliderService())->handle($data);

        // Return success response
        return redirect()->back();
    }
}
