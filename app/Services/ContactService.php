<?php

namespace App\Services;

use App\Models\ContactMessage;

class ContactService{
    public function store($data){
        // Make new message data
        $new_message = new ContactMessage();
        $new_message->email = $data['email'];
        $new_message->name = $data['name'];
        $new_message->phone = $data['phone'];
        $new_message->product_name = $data['product_name'];
        $new_message->message = $data['message'];
    
        // Save data to DB
        $new_message->save();

        return true;
    }
}