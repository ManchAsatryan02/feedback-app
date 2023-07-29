<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\FeedbackService;
use App\Traits\ImageUploadTrait;

class FeedbackController extends Controller
{
    use ImageUploadTrait;

    protected $feedBackService;
    
    public function __construct(FeedbackService $feedBackService){
        $this->feedBackService = $feedBackService;
    }

    // Feedback page show
    public function index(Request $request){
        // Get feedback data
        $feedback_items = Feedback::where('status', 1)->orderBy('id', 'desc')->get();

        // Make empty data array
        $data = (object)[];

        // Push all page data to array
        $data->feedback_items = $feedback_items;
        
        // Return data with Json
        return response()->json($data);
    }
    
    // Send message from home page as feedback
    public function send_feedback(FeedbackRequest $request){
        // Validate sended datas
        $validate = $request->validate();

        $data = $request->all();

        $this->feedBackService->store($data);

        // Return success response
        return response()->json([
            'status' => true
        ]);
    }
}
