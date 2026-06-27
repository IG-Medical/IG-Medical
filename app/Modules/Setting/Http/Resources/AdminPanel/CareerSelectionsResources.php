<?php


namespace Setting\Http\Resources\AdminPanel;


use Illuminate\Http\Resources\Json\JsonResource;

class CareerSelectionsResources extends JsonResource
{
    public function toArray($request)
    {
        $career = $this->career;

        return [
            'id' => isset($career) ? $career->id : null,
            'job_title' => isset($career) ? $career->job_title : null,
            'type' => $this->type,
        ];
    }
}
