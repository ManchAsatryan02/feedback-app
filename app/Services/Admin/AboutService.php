<?php
namespace App\Services\Admin;

use App\Models\About;

class AboutService
{
    public function handle($data)
    {
        // Make new about data
        $about_data = About::first();
        $about_data->description_en = $data['description_en'];
        $about_data->description_ru = $data['description_ru'];
        $about_data->description_hy = $data['description_hy'];
    
        // Save data to DB
        $about_data->save();

        return true;
    }
    
}