<?php

namespace App\Http\Controllers\Upload;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadFileController extends Controller
{
    use UploadTrait;


    public function uploadImage(Request $request, $dir)
    {
        $request->validate([
            'img' => $this->imageRules(true)
        ]);

        $image = $this->saveBase64Image($request->img, $dir);

        return [
            "location" => basename($image)
        ];
    }


    public function uploadFileOnCrop(Request $request, $dir)
    {
        $request->validate([
            'img' => $this->imageRules(true)
        ]);

        $file = $request->file('img');


        if (aws_is_s3())
            $image = $this->uploadToS3($file, $dir);
        else
            $image = $this->saveFile($file, $dir);

        $name = basename($image);
        return [
            "location" => basename($image),
            'file_url' => $this->getPathFile($dir, $name),
        ];
    }

    public function uploadFile(Request $request)
    {
        $dir = $request->upload;

        $validator = Validator::make($request->all(), $this->validateFile($dir));

        if ($validator->fails()) {
            return $this->successResponse(false, $validator->errors()->first());
        }


        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $OriginalName = $file->getClientOriginalName();
            $size = $file->getSize();
            $mimeType = $file->getClientMimeType();

            if (aws_is_s3())
                $file = $this->uploadToS3($file, $dir);
            else
                $file = $this->saveFile($file, $dir);

            $name = basename($file);

            return response()->json([
                'location' => $this->getPathFile($dir, $name),
                'url' => $this->getPathFile($dir, $name),
                'file_link' => $name,
                'name' => $OriginalName,
                'size' => $size,
                'mimeType' => $mimeType,
            ], 200);
        }
    }

    public function multipleUploadFile(Request $request)
    {
        $dir = $request->upload;

        $validator = Validator::make($request->all(), $this->validateFile($dir));

        if ($validator->fails()) {
            return $this->successResponse(false, $validator->errors()->first());
        }

        $paths = [];
        $names = [];
        $pathDB = [];

        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                $OriginalName = $file->getClientOriginalName();
                if (aws_is_s3())
                    $fileName = $this->uploadToS3($file, $dir);
                else
                    $fileName = $this->saveFile($file, $dir);

                $name = basename(url($fileName));
                $paths[] = ['url' => $this->getPathFile($dir, $name), 'file_name' => $OriginalName, 'file_link' => $name];
                $pathDB[] = ['url' => $fileName, 'name' => $OriginalName];
                $names[] = $name;
            }

            return response()->json([
                'path' => $paths,

            ], 200);
        }
    }

    public function uploadEditor(Request $request)
    {
        return $this->uploadFile($request);
    }

}
