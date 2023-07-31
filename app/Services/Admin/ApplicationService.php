<?php
namespace App\Services\Admin;
                    
use App\Traits\ImageUploadTrait;
use App\Models\Appliction;

class ApplicationService
{
    use ImageUploadTrait;

    public function store($data, $id = null){
        // Check update or store
        if($id == null){ // Store
           // Make new application data
        $new_application = new Appliction;
        }else{ // Update
           // Make new application data
            $new_application = Appliction::findOrFail($id);
        }
        $new_application->title_en = $data['title_en'];
        $new_application->title_ru = $data['title_ru'];
        $new_application->title_hy = $data['title_hy'];
        $new_application->description_en = $data['description_en'];
        $new_application->description_ru = $data['description_ru'];
        $new_application->description_hy = $data['description_hy'];
    
        // Check has request image or not
        if (isset($data['img'])) {
            // Uploading
            $imagename = $this->handle($data['img'], 'application', 1, $new_application->img);

            // Add image filed before save data
            $new_application->img = $imagename;
        }
        
        // Check has request exc or not
        if (isset($data['exc'])) {
            // Uploading
            $excfilename = $this->handleFile($data['exc'], 'application/files', $new_application->exc);

            // Add excell filed before save data
            $new_application->exc = $excfilename;
        }

        // Check has request pdf or not
        if (isset($data['pdf'])) {
            // Uploading
            $pdffilename = $this->handleFile($data['pdf'], 'application/files', $new_application->pdf);

            // Add pdf filed before save data
            $new_application->pdf = $pdffilename;
        }

        // Check has request word or not
        if (isset($data['word'])) {
            // Uploading
            $wordfilename = $this->handleFile($data['word'], 'application/files', $new_application->word);

            // Add word filed before save data
            $new_application->word = $wordfilename;
        }

        // Save data to db
        $new_application->save();

        return true;
    }

    public function destroy($id){
        // Find application item
        $application = Appliction::findOrFail($id);

        // Unlink image
        $imagename = $this->unlinkFile($application->img, 'application');

        // Unlink pdf
        $pdfname = $this->unlinkFile($application->pdf, 'application/files');

        // Unlink exc
        $excname = $this->unlinkFile($application->exc, 'application/files');

        // Unlink word
        $wordname = $this->unlinkFile($application->word, 'application/files');

        // Destroy application item data
        $application->delete();

        return true;
    }
}