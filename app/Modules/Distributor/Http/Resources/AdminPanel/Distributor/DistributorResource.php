<?php


namespace Distributor\Http\Resources\AdminPanel\Distributor;


use Illuminate\Http\Resources\Json\JsonResource;

class DistributorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "show_map" => $this->show_map == YES ? trans_module_distributor('admin.true') : trans_module_distributor('admin.false'),
            "lat" => $this->lat,
            "long" => $this->long,
            "location" => '[' . $this->long . ',' . $this->lat . ']',
            "image_url" => $this->image_url,
            "created_at" => $this->created_at,
        ];
    }
}
