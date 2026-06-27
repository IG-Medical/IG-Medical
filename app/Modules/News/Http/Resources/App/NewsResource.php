<?php


namespace News\Http\Resources\App;


use Carbon\Carbon;
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
            "short_content" => $this->short_content,
            "date" => Carbon::parse($this->created_at)->format(config('app.date_format_db')),
        ];
    }
}
