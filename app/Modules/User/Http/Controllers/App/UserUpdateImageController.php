<?php

namespace User\Http\Controllers\App;

use Illuminate\Http\Request;
use User\Models\User;

class UserUpdateImageController extends CoreController
{
    private $DIR_IMAGE_UPLOADS = User::DIR_IMAGE_UPLOADS;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'img' => image_rules(true)
        ]);

        if (aws_is_s3()) {
            $image = $this->updateImageToS3($request);
        } else {
            $image = $this->updateImageToLocal($request);
        }

        $db_image = basename($image);
        $user = user()->update([
            'image' => $db_image
        ]);

        return response()->json(['location' => $db_image]);
    }

    private function updateImageToS3(Request $request)
    {
        $dir = DIR_UPLOAD($this->DIR_IMAGE_UPLOADS) . '/' . WITH_300 . '/';
        return $request->file('img')->store($dir, 's3');
    }

    private function updateImageToLocal(Request $request)
    {
        return saveBase64Image($request->img, $this->DIR_IMAGE_UPLOADS);
    }
}
