<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'project_type_id' => $this->project_type_id,
            'project_type_name' => $this->projectType->name,
            'title' => $this->title,
            'description' => $this->description,
            'link_web' => $this->link_web,
            'link_app' => $this->link_app,
            'platform' => $this->platform,
            'order' => $this->order,
            'status' => $this->status
        ];


    }
}
