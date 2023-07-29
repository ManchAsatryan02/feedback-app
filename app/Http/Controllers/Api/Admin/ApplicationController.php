<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appliction;
use App\Requests\Admin\ApplicationRequest;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get application data
        $application_items = Appliction::orderBy('id', 'desc')->get();

        // Return data with Json
        return response()->json($application_items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationRequest $request)
    {
        // Validate sended datas
        $validate = $request->validate();
      
        $data = $request->all();

        $this->ApplicationRequest()->store($data);

        // Return success response
        return response([
            'message' => 'Application added successfully !'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get application detail data
        $application_detail = Appliction::findOrFail($id);

        // Return data with Json
        return response()->json($application_detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate sended datas
        $validate = $request->validate();
         
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find application item
        $application = Appliction::findOrFail($id);

        // Get image path
        $image_path = 'assets/images/application/'.$application->img;

        // Check image file exists
        if(file_exists($image_path)) {
           // Destroy from storage
            unlink($image_path);
        }

        // Get exc path
        $exc_path = 'assets/files/application/'.$application->exc;

        // Check exc exists
        if(file_exists($exc_path)) {
            // Destroy from storage
            unlink($exc_path);
        }

        // Get word path
        $word_path = 'assets/files/application/'.$application->word;

        // Check word exists
        if(file_exists($word_path)) {
            // Destroy from storage
            unlink($word_path);
        }

        // Get pdf path
        $pdf_path = 'assets/files/application/'.$application->pdf;

        // Check pdf exists
        if(file_exists($pdf_path)) {
            // Destroy from storage
            unlink($pdf_path);
        }

        // Destroy application item data
        $application->delete();

        // Return succes response
        return response()->json([
            'message' => 'Application item removed successfully'
        ]);
    }
}
