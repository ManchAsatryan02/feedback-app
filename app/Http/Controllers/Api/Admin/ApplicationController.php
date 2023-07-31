<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appliction;
use App\Http\Requests\Admin\ApplicationRequest;
use App\Services\Admin\ApplicationService;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get application data
        $application_items = Appliction::orderBy('id', 'desc')->get();

        // Return data to view
        return view('admin.pages.application', compact('application_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationRequest $request)
    {
        // Validate sended datas
        $validate = $request->validated();
      
        $data = $request->all();

        (new ApplicationService())->store($data);

        // Return success response
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get application detail data
        $application_item = Appliction::findOrFail($id);

        // Return data to view
       return view('admin.edit.application', compact('application_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApplicationRequest $request, string $id)
    {
        // Validate sended datas
        $validate = $request->validated();
      
        $data = $request->all();

        (new ApplicationService())->store($data, $id);

        // Return success response
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        (new ApplicationService())->destroy($id);

        // Return succes response
        return redirect()->back();
    }
}
