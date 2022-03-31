<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'body'=> $this->body,
            'likes' => $this->likes->count(),
             //this code how call postResource with UserResource
            'author'=>new UserResource($this->user),

        ];

    }


}
