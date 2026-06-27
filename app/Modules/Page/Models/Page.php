<?php

namespace Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'content'];

    protected $guarded = [];

    public static function pages()
    {
        return Cache::remember('pages', CACHE_TTL, function () {
            return self::select('id', 'title', 'slug', 'content')->get();
        });
    }
}
