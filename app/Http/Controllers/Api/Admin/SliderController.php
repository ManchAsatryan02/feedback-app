<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

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
    public function update(Request $request)
    {
        // Validate sended datas
        $validator = Validator::make($request->all(), [
            'video_url' => 'required|string|max:50',
            'description_en' => 'required|string|max:16777215',
            'description_ru' => 'required|string|max:16777215',
            'description_hy' => 'required|string|max:16777215',
        ]);
         
        // Checking validated data
        if($validator->fails()) { // Has incorrect part
            // Return error response
            return response([
                'message' => 'Provided data is incorrect'
            ], 422);
        }else{ // All of correct
            // Make new slider data
            $new_slider = Slider::first();
            $new_slider->video_url = $request->video_url;
            $new_slider->description_en = $request->description_en;
            $new_slider->description_ru = $request->description_ru;
            $new_slider->description_hy = $request->description_hy;

            // Save data to DB
            $new_slider->save();

            // Return success response
            return response([
                'message' => 'Slider updated successfully !'
            ]);
        }
    }
}
