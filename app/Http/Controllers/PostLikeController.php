<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostLikeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post , Request $request){

       // dd($post);

      // $this->authorize('like', $post);
       if ($post->user_id === $request->user()->id){
           return response(null,401);
       }
       $post->likes()->create([
           'user_id'=>$request->user()->id,
       ]);



       return  new PostResource($post);
    }
}
