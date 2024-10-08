<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'        => $this->title,
            'slug'         => $this->slug,
            'content'      => $this->content,
            'tags'         => $this->tags ? $this->tags->pluck('name') : [],
            'type'         => $this->blogable_type,
            'published_at' => $this->published_at,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at
        ];
    }
}
