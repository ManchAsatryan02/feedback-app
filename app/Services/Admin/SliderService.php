<?php
namespace App\Services\Admin;

use App\Models\Slider;
                    
class SliderService
{
    public function handle($data)
    {
        // Make new slider data
        $new_slider = Slider::first();
        $new_slider->video_url = $data['video_url'];
        $new_slider->description_en = $data['description_en'];
        $new_slider->description_ru = $data['description_ru'];
        $new_slider->description_hy = $data['description_hy'];

        // Save data to DB
        $new_slider->save();

        return true;
    }
    
}