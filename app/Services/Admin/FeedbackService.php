<?php
namespace App\Services\Admin;

use App\Models\Feedback;
use App\Traits\ImageUploadTrait;
                    
class FeedbackService
{
    use ImageUploadTrait;
        
    public function store($data, $id)
    {
        // Make new feedback data
        $new_feedback = Feedback::findOrFail($id);
        $new_feedback->title = $data['title'];
        $new_feedback->phone = $data['phone'];
        $new_feedback->description = $data['description'];
        $new_feedback->status = $data['status'];
    
        // Check has request image or not
        if (isset($data['img'])) {
            // Uploading
            $filename = $this->handle($data['img'], 'feedback', 1, $new_feedback->img);

            // Add image filed before save data
            $new_feedback->img = $filename;
        }

        // Save data to DB
        $new_feedback->save();

        return true;
    }

    public function destroy($id){
        // Find feedback item
        $feedback = Feedback::findOrFail($id);

        // Unlink image
        $imagename = $this->unlinkFile($feedback->img, 'feedback');

        // Destroy feedback item data
        $feedback->delete();

        return true;
    }
    
}