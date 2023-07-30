<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Requests\SliderRequest;
use App\Services\SliderService;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get slider data
        $slider_items = Slider::orderBy('id', 'desc')->get();

        // Return data with Json
        return response()->json($slider_items);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request)
    {
        // Validate sended datas
        $validate = $request->validate();
         
       $data = $request->all();

       $this->SliderService()->handle();

        // Return success response
        return response([
            'message' => 'Slider updated successfully !'
        ]);
    }
}
