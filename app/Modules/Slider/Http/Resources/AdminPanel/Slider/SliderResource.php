<?php


namespace Slider\Http\Resources\AdminPanel\Slider;


use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray($request)
    {
        $type = '';
        if ($this->home_page_center) {
            $type = 'Home Page Center';
        }
        if ($this->home_page_top) {
            $type = 'Home Page Top';
        }
        if ($this->home_page_center && $this->home_page_top) {
            $type = 'Home Page Center <br> Home Page Top';
        }


        return [
            'id' => $this->id,
            'caption_1' => $this->caption_1,
            'caption_2' => $this->caption_2,
            'caption_3' => $this->caption_3,
            'call_to_action_text_1' => $this->call_to_action_text_1,
            'call_to_action_text_2' => $this->call_to_action_text_2,
            'call_to_action_url_1' => $this->call_to_action_url_1,
            'call_to_action_url_2' => $this->call_to_action_url_2,
            'background_url' => $this->show_background_url,
            'created_at' => $this->created_at,
            'home_page_center' => $this->home_page_center,
            'home_page_top' => $this->home_page_top,
            'type' => $this->type ?? 'web',
            'position_label' => $type,
        ];
    }
}
