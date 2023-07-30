<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Requests\FeedbackRequest;
use App\Service\FeedbackService;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get feedback data
        $feedback_items = Feedback::orderBy('id', 'desc')->get();

        // Return data with Json
        return response()->json($feedback_items);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FeedbackRequest $request)
    {
        // Validate sended datas
        $validate = $request->validate();
         
        $data = $request->all();

        $this->FeedbackService()->store($data);

        // Return success response
        return response([
            'message' => 'Feedback sended successfully !'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get feedback detail data
        $feedback_detail = Feedback::findOrFail($id);

        // Return data with Json
        return response()->json($feedback_detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeedbackRequest $request, string $id)
    {
        // Validate sended datas
        $validate = $request->validate();
         
        $data = $request->all();

        $this->FeedbackService()->update($data);

        // Return success response
        return response([
            'message' => 'Feedback updated successfully !'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find feedback item
        $feedback = Feedback::findOrFail($id);

        // Get image path
        $image_path = 'assets/images/feedback/'.$feedback->img;

        // Check image file exists
        if(file_exists($image_path)) {
           // Destroy from storage
            unlink($image_path);
        }

        // Destroy feedback item data
        $feedback->delete();

        // Return succes response
        return response()->json([
            'message' => 'Feedback item removed successfully'
        ]);
    }
}
