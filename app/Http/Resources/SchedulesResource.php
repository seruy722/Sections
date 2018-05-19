<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchedulesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'days_of_week' => $this->days_of_week,
            'event_name' => $this->event_name,
            'event_info' => $this->event_info,
            'data_start' => $this->data_start,
            'data_end' => $this->data_end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}