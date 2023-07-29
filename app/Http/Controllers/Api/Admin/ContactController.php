<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get contcact data
        $contcact_items = ContactMessage::orderBy('id', 'desc')->get();

        // Return data with Json
        return response()->json($contcact_items);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get contcat detail data
        $contcat_detail = ContactMessage::findOrFail($id);

        // Make empty data array
        $data = (object)[];

        // Push all page data to array
        $data->contcat_detail = $contcat_detail;
        
        // Return data with Json
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find contact item and delete
        ContactMessage::findOrFail($id)->delete();

        // Return succes response
        return response()->json([
            'message' => 'Contact message removed successfully'
        ]);
    }
}
