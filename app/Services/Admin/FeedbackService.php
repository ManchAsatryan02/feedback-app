<?php
namespace App\Services\Admin;

use App\Models\Feedback;
                    
class FeedbackService
{
        
    public function store($data)
    {
        // Make new feedback data
        $new_feedback = new Feedback;
        $new_feedback->title = $data['title'];
        $new_feedback->phone = $data['phone'];
        $new_feedback->description = $data['description'];
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
    }

    public function update(){
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

            // Save data to DB
            $new_feedback->save();

            // Return success response
            return response([
                'message' => 'Feedback updated successfully !'
            ]);
        }
    }
    
}