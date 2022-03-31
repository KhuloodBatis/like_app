<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Http\Resources\PostUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'body'=> $this->body,
            'likes' => $this->likes->count(),
            //'likers' => $this->likers,this return all fromation for likers
            'likers' => LikersResource::collection($this->likers),
            //'likers'=> new UserResource($this->likers),that wronge
             //this code how call postResource with UserResource
             'likes_remaining' =>$this->likesRemainingFor($this->user),
            'author'=>new UserResource($this->user),
         //'user' => new PostUserResource($this->post->auth()->user_id),

        ];

    }


}
