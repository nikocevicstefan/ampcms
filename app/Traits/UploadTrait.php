<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    private function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        if (!is_null($filename)) {
            $name = $filename;
        } else {
            $name = 'avatar.png';
        }

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    public function nameFile($name, $request)
    {
        $imageName = $name . '_' . $request . time();
        $image = request()->file($request);
        $folder = '/img/'.$name.'_images/';
        $filePath = $imageName . '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $imageName);
        return $filePath;
    }
}

