<?php

namespace Product\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadRequestsProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
