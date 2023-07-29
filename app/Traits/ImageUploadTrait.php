<?php

namespace App\Traits;

trait ImageUploadTrait{

    public function handle($file, $folder, $type = 0) {
        $image = $file;

        if($type == 0){
            $base64String = $image;
            
            list($extension, $content) = explode(';', $base64String);
            
            $tmpExtension = explode('/', $extension);
            
            preg_match('/.([0-9]+) /', microtime(), $m);
            
            $fileName = sprintf(time() .'%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
            
            $content = explode(',', $content)[1];
            
            $storage = Storage::disk('public');
            
            $checkDirectory = $storage->exists($folder);
            
            if (!$checkDirectory) {
                $storage->makeDirectory($folder);
            }
            
            $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');
        }else{
            $storage = Storage::disk('public');
            $fileName = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();
            $storage->put($folder . '/' . $fileName, $image, 'public');
        }

        $webp = 'storage/'. $folder. '/'.$fileName;
        
        $im = imagecreatefromstring(file_get_contents($webp));
        
        imagepalettetotruecolor($im);
        
        $imageName1 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $fileName);
        
        $fileName = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $webp);
        
        unlink($webp);
        
        imagewebp($im, $fileName, 100);

        return $imageName1;
    }
}
