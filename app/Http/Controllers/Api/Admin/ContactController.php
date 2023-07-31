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
        $contact_items = ContactMessage::orderBy('id', 'desc')->get();

        // Return data to view
        return view('admin.pages.contact', compact('contact_items'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find contact item and delete
        ContactMessage::findOrFail($id)->delete();

        // Return success redirect
        return redirect()->back();
    }
}
