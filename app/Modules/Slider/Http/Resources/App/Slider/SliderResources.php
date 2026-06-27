<?php


namespace Slider\Http\Resources\App\Slider;


use Illuminate\Http\Resources\Json\JsonResource;

class SliderResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'caption_1' => $this->caption_1,
            'caption_2' => $this->caption_2,
            'caption_3' => $this->caption_3,
            'call_to_action_text_1' => $this->call_to_action_text_1,
            'call_to_action_url_1' => $this->call_to_action_url_1,
            'call_to_action_text_2' => $this->call_to_action_text_2,
            'call_to_action_url_2' => $this->call_to_action_url_2,
            'show_background_url' => $this->show_background_url,
        ];
    }
}
