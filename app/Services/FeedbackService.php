<?php

namespace App\Services;

use App\Models\Feedback;

class FeedbackService {
    public function store($data){
        // Make new feedback data
        $new_feedback = new Feedback();
        $new_feedback->title = $data['title'];
        $new_feedback->phone = $data['phone'];
        $new_feedback->description = $data['description'];
    
        // Check has request image or not
        if ($data['img']) { // Has a image
            // Uploading
            $filename = $this->handle($data['img'], 'feedback');

            // Add image filed before save data
            $new_feedback->img = $filename;
        }else{ // Has not a image
            // Add image filed before save data
            $new_feedback->img = NULL;
        }

        // Save data to DB
        $new_feedback->save();

        return true;
    }
}