<?php


namespace Contact\Http\Resources\AdminPanel\ContactUS;


use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'country' => $this->country,
            'product' => isset($this->product) ? $this->product->name : '',
            'phone' => $this->phone,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'subject' => $this->subject,
        ];
    }
}
