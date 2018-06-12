<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request)
    {
        $need_date = date('d-m-Y', strtotime($this->created_at));
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image_name' => $this->image_name,
            'section_id' => $this->section_id,
            'section_name'=>$this->sections->section_name,
            'created_at' => $need_date
        ];
    }
}
