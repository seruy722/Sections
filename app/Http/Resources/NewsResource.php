<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $need_date = date('d-m-Y', strtotime($this->created_at));
        return [
            'id' => $this->id,
            'user_name' => optional($this->user)->name,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image_filename' => $this->image_filename,
            'user_id' => $this->user_id,
            'active' => $this->active,
            'created_at' => $need_date
        ];
    }
}
