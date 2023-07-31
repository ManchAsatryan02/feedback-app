<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Http\Requests\Admin\FeedbackRequest;
use App\Services\Admin\FeedbackService;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get feedback data
        $feedback_items = Feedback::orderBy('id', 'desc')->get();

        // Return data to view
        return view('admin.pages.feedback', compact('feedback_items'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get feedback detail data
        $feedback_item = Feedback::findOrFail($id);

       // Return data to view
       return view('admin.edit.feedback', compact('feedback_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeedbackRequest $request, string $id)
    {
        // Validate sended datas
        $validate = $request->validated();
         
        $data = $request->all();

       (new FeedbackService())->store($data, $id);

        // Return success response
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        (new FeedbackService())->destroy($id);

        // Return succes response
        return redirect()->back();
    }
}
