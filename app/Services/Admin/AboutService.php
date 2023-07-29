<?php
namespace App\Services\Admin;

use App\Models\About;

class AboutService
{
    public function handle($data)
    {
        // Make new about data
        $about_data = About::first();
        $about_data->title_en = $data['title_en'];
        $about_data->title_ru = $data['title_ru'];
        $about_data->title_hy = $data['title_hy'];
        $about_data->description_en = $data['description_en'];
        $about_data->description_ru = $data['description_ru'];
        $about_data->description_hy = $data['description_hy'];
    
        // Save data to DB
        $about_data->save();

        return true;
    }
    
}