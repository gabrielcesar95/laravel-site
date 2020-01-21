<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Comment;

class Post extends JsonResource
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
            'user' => $this->when($request->get('recursive'), $this->user),
            'name' => $this->name,
            'slug' => $this->slug,
            'url' => route('web.post.show', $this->slug),
            'categories' => $this->categories,
            //TODO: get comments (polymorphic relationship)
            'comments' => $this->when($request->get('recursive'), $this->comments),
            'subtitle' => $this->subtitle,
            'content' => $this->content,
            'cover' => $this->cover,
            'views' => $this->views,
            'posted_at' => $this->posted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
