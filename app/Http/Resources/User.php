<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Post;

class User extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'email_verified' => $this->when($this->email_verified_at, true),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'posts' => $this->when($request->get('recursive'), Post::collection($this->posts)),
        ];
    }
}
