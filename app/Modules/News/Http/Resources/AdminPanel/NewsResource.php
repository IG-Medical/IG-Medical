<?php


namespace News\Http\Resources\AdminPanel;


use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "image_url" => isset($this->image_url[getAppLocale()]) ? $this->image_url[getAppLocale()] : null,
            "title" => $this->title,
            "slug" => $this->slug,
            "content" => $this->content,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
