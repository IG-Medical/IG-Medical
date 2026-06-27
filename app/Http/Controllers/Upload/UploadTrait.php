<?php


namespace App\Http\Controllers\Upload;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Setting\Models\Setting;
use User\Models\User;


trait UploadTrait
{
    private function imageRules($required = false, $maxSize = MAX_SIZE_UPLOAD_FILE): array
    {
        return [
            $required ? 'required' : 'nullable',
            'image', 'max:' . $maxSize,
            'mimes:jpeg,png,jpg'
        ];
    }


    private function saveBase64Image($image, $direction)
    {
        $dir = DIR_UPLOAD . '/' . $direction;
        File::exists(my_public() . $dir) or File::makeDirectory(my_public() . $dir, 755, true);
        File::exists(my_public() . $dir . '/1000') or File::makeDirectory(my_public() . $dir . '/1000', 755, true);
        File::exists(my_public() . $dir . '/600') or File::makeDirectory(my_public() . $dir . '/600', 755, true);
        File::exists(my_public() . $dir . '/300') or File::makeDirectory(my_public() . $dir . '/300', 755, true);

        $img = Image::make($image);
        $mime = explode('/', $img->mime)[1];
        $file_name = rand(100, 9999999) . '.' . $mime;

        $img->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(my_public() . $dir . '/1000/' . $file_name);

        $img->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(my_public() . $dir . '/600/' . $file_name);

        $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(my_public() . $dir . '/300/' . $file_name);

        return $file_name;
    }

    private function validateFile($type)
    {
        $MAX_SIZE_UPLOAD_FILE = MAX_SIZE_UPLOAD_FILE;
        $mimesImage = MIMES_IMAGE;
        $mimesDocuments = MIMES_DOCUMENTS;
        $mimesExcel = MIMES_EXCEL;
        $mimesPowerPoint = MIMES_POWERPOINT;
        $mimesZip = MIMES_ZIP;
        $mimesVideo = MIMES_VIDEO;

        switch ($type) {
            case User::DIR_IMAGE_UPLOADS:
                return ['file' => 'required|max:' . $MAX_SIZE_UPLOAD_FILE . '|mimes:' . $mimesImage];
                break;
            case Setting::DIR_BREADCRUMBS_UPLOADS:
                //.'|dimensions:width=300,height=912'
                return ['file' => 'required|max:' . $MAX_SIZE_UPLOAD_FILE . '|mimes:' . $mimesImage];
                break;
            default:
                return [
                    'file' => 'required|max:' . $MAX_SIZE_UPLOAD_FILE,
                ];
        }
    }

    private function uploadToS3($file, $direction)
    {
        $dir = DIR_UPLOAD($direction);
        return $file->store($dir, 's3');
    }

    private function getPathFile($path, $file)
    {
        return assetUpload($path . '/' . $file);
    }

    private function saveFile($file, $direction)
    {
        $mime = $file->getClientOriginalExtension();
        $path = my_public() . DIR_UPLOAD . DIRECTORY_SEPARATOR . $direction;
        File::exists($path) or File::makeDirectory($path, 755, true);
        $file_name = rand(100, 9999999) . '.' . $mime;
        $file->move($path, $file_name);
        return $file_name;
    }

}
