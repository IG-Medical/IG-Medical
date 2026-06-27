<?php

namespace Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttachments extends Model
{
    use HasFactory;

    public const DIR_UPLOADS = 'products';
    protected $appends = ['file_url', 'name', 'url'];

    public static function store(array $attaches, $Id)
    {
        self::where('product_id', $Id)->delete();

        if (count($attaches) > 0) {
            $array = [];
            foreach ($attaches as $attach) {
                $array[] = [
                    'product_id' => $Id,
                    'file_link' => $attach['file_link'],
                    'file_name' => $attach['name'],
                    //'file_type' => $attach['mimeType'],
                    //'file_size' => $attach['size'],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ];
            }
            return self::insert($array);
        }
    }


    public function getFileUrlAttribute() // library "El elements -> Component Vue JS" upload images
    {
        return $this->file_link;
    }


    public function getNameAttribute()
    {
        return $this->file_name;
    }

    public function getUrlAttribute()
    {
        return assetUpload(self::DIR_UPLOADS . '/' . $this->file_link);
    }
}
