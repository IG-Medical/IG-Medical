<?php

namespace Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OptionValue extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
    public $translatable = ['label'];


    public static function store($data, $id)
    {
        if (count($data) > 0) {
            self::where('option_id', $id)->delete();
            foreach ($data as $key => $value) {
                $array = [
                    'option_id' => $id,
                    'label' => $value['label'],
                    'price' => $value['price'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
                self::create($array);
            }
        }
    }
}
