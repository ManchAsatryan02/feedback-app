<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

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
    public function store(Request $request)
    {
        // Validate sended datas
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:16777215',
            'phone' => 'required|max:50',
        ]);
         
        // Checking validated data
        if($validator->fails()) { // Has incorrect part
            // Return error response
            return response([
                'message' => 'Provided data is incorrect'
            ], 422);
        }else{ // All of correct
            // Make new feedback data
            $new_feedback = new Feedback;
            $new_feedback->title = $request->title;
            $new_feedback->phone = $request->phone;
            $new_feedback->description = $request->description;
            $new_feedback->status = 1;
        
            // Check has request image or not
            if ($request->hasFile('img')) { // Has a image
                // Get image file
                $image = $request->file('img');
    
                // Make image new name
                $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();

                // Get path
                $image_path = 'assets/images/feedback/' . $filename;

                // Save the image to a specific path
                $image->save($image_path);

                // Add image filed before save data
                $new_feedback->img = $filenema;
            }else{ // Has not a image
                // Add image filed before save data
                $new_feedback->img = NULL;
            }

            // Save data to DB
            $new_feedback->save();

            // Return success response
            return response([
                'message' => 'Feedback sended successfully !'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get feedback detail data
        $feedback_detail = Feedback::findOrFail($id);

        // Make empty data array
        $data = (object)[];

        // Push all page data to array
        $data->feedback_detail = $feedback_detail;
        
        // Return data with Json
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate sended datas
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:16777215',
            'phone' => 'required|max:50',
            'status' => 'required',
        ]);
         
        // Checking validated data
        if($validator->fails()) { // Has incorrect part
            // Return error response
            return response([
                'message' => 'Provided data is incorrect'
            ], 422);
        }else{ // All of correct
            // Make new feedback data
            $new_feedback = Feedback::findOrFail($id);
            $new_feedback->title = $request->title;
            $new_feedback->phone = $request->phone;
            $new_feedback->description = $request->description;
            $new_feedback->status = $request->status;
        
            // Check has request image or not
            if ($request->hasFile('img')) { // Has a image
                // Get image file
                $image = $request->file('img');
    
                // Make image new name
                $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();

                // Get path
                $image_path = 'assets/images/feedback/' . $filename;

                // Save the image to a specific path
                $image->save($image_path);

                // Add image filed before save data
                $new_feedback->img = $filenema;

                // Get old image path
                $old_image_path = 'assets/images/feedback/'.$image;

                // Check image file exists
                if(file_exists($old_image_path)) {
                    // Destroy from storage
                    unlink($old_image_path);
                }
            }

            // Save data to DB
            $new_feedback->save();

            // Return success response
            return response([
                'message' => 'Feedback updated successfully !'
            ]);
        }
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
