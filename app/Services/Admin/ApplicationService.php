<?php
namespace App\Services\Admin;
                    
use App\Traits\ImageUploadTrait;

class ApplicationService
{
    use ImageUploadTrait;

    public function store($data)
    {
        // Make new application data
        $new_application = new Appliction;
        $new_application->title_en = $request->title_en;
        $new_application->title_ru = $request->title_ru;
        $new_application->title_hy = $request->title_hy;
        $new_application->description_en = $request->description_en;
        $new_application->description_ru = $request->description_ru;
        $new_application->description_hy = $request->description_hy;
    
        // Check has request image or not
        if ($request->hasFile('img')) { // Has a image
           $filename = $this->handle($request->img, 'applications', 1);

            // Add image filed before save data
            $new_application->img = $filename;
        }else{ // Has not a image
            // Add image filed before save data
            $new_application->img = NULL;
        }

        // Check has request exc or not
        if ($request->hasFile('exc')) { // Has a file
            // Get file file
            $exc = $request->file('exc');

            // Make file new name
            $excname = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $exc->getClientOriginalExtension();

            // Get path
            $exc_path = 'assets/files/application/' . $excname;

            // Save the file to a specific path
            $file->save($exc_path);

            // Add file filed before save data
            $new_application->exc = $excname;
        }else{ // Has not a file
            // Add file filed before save data
            $new_application->exc = NULL;
        }

        // Check has request pdf or not
        if ($request->hasFile('pdf')) { // Has a pdf
            // Get pdf file
            $pdf = $request->file('pdf');

            // Make pdf new name
            $pdfname = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $pdf->getClientOriginalExtension();

            // Get path
            $pdf_path = 'assets/files/application/' . $pdfname;

            // Save the file to a specific path
            $pdf->save($pdf_path);

            // Add file filed before save data
            $new_application->pdf = $pdfname;
        }else{ // Has not a file
            // Add file filed before save data
            $new_application->pdf = NULL;
        }

        // Check has request word or not
        if ($request->hasFile('word')) { // Has a word
            // Get word file
            $word = $request->file('word');

            // Make word new name
            $wordname = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $word->getClientOriginalExtension();

            // Get path
            $word_path = 'assets/files/application/' . $wordname;

            // Save the file to a specific path
            $word->save($word_path);

            // Add file filed before save data
            $new_application->word = $wordname;
        }else{ // Has not a file
            // Add file filed before save data
            $new_application->word = NULL;
        }

        // Save data to DB
        $new_application->save();

        return true;
    }

    public function update($data){
        // Make new application data
        $new_application = Appliction::findOrFail($id);
        $new_application->title_en = $data['title_en'];
        $new_application->title_ru = $data['title_ru'];
        $new_application->title_hy = $data['title_hy'];
        $new_application->description_en = $data['description_en'];
        $new_application->description_ru = $data['description_ru'];
        $new_application->description_hy = $data['description_hy'];
    
        // Check has request image or not
        if ($request->hasFile('img')) { // Has a image
            $filename = $this->handle($request->img, 'applications', 1);

            // Add image filed before save data
            $new_application->img = $filename;

            // Get old image path
            $old_image_path = 'assets/images/application/'.$application->img;

            // Check image file exists
            if(file_exists($old_image_path)) {
                // Destroy from storage
                unlink($old_image_path);
            }
        }

        // Check has request exc or not
        if ($request->hasFile('exc')) { // Has a file
            // Get file file
            $exc = $request->file('exc');

            // Make file new name
            $excname = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $exc->getClientOriginalExtension();

            // Get path
            $exc_path = 'assets/files/application/' . $excname;

            // Save the file to a specific path
            $file->save($exc_path);

            // Add file filed before save data
            $new_application->exc = $excname;

            // Get old exc path
            $old_exc_path = 'assets/images/application/'.$application->exc;

            // Check exc file exists
            if(file_exists($old_exc_path)) {
                // Destroy from storage
                unlink($old_exc_path);
            }
        }

        // Check has request pdf or not
        if ($request->hasFile('pdf')) { // Has a pdf
            // Get pdf file
            $pdf = $request->file('pdf');

            // Make pdf new name
            $pdfname = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $pdf->getClientOriginalExtension();

            // Get path
            $pdf_path = 'assets/files/application/' . $pdfname;

            // Save the file to a specific path
            $pdf->save($pdf_path);

            // Add file filed before save data
            $new_application->pdf = $pdfname;

            // Get old pdf path
            $old_pdf_path = 'assets/images/application/'.$application->pdf;

            // Check pdf file exists
            if(file_exists($old_pdf_path)) {
                // Destroy from storage
                unlink($old_pdf_path);
            }
        }

        // Check has request word or not
        if ($request->hasFile('word')) { // Has a word
            // Get word file
            $word = $request->file('word');

            // Make word new name
            $wordname = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $word->getClientOriginalExtension();

            // Get path
            $word_path = 'assets/files/application/' . $wordname;

            // Save the file to a specific path
            $word->save($word_path);

            // Add file filed before save data
            $new_application->word = $wordname;
        
            // Get old word path
            $old_word_path = 'assets/images/application/'.$application->word;

            // Check word file exists
            if(file_exists($old_word_path)) {
                // Destroy from storage
                unlink($old_word_path);
            }

            // Save data to DB
            $new_application->save();

            // Return success response
            return response([
                'message' => 'Application updated successfully !'
            ]);
        }
    }
    
}