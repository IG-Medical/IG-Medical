<?php


namespace App\Http\Resources\AdminPanel\MailingList;


use Illuminate\Http\Resources\Json\JsonResource;

class MailingListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'created_at' => $this->created_at,
        ];
    }
}
