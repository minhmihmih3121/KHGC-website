<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
            'image_url' => $this->image_url,
            'section_id' => $this->section_id,
            'heading' => $this->heading,
            'sub_heading' => $this->sub_heading,
            'alt' => $this->alt,
            'cover_color' => $this->cover_color,
            'link' => $this->link,
            'views' => $this->views,
            'clicks' => $this->clicks,
            'status' => $this->status,
            'order' => $this->order
        ];
    }
}
