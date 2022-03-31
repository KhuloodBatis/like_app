<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Post $post)
    {   dd($post->likers);
        $posts = Post::latest()->get();
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'body' => 'required',
        ]);
        //this code is wrong because i didn't add user
        // $post = Post::create(
        //     ['body'=>$request->body,]
        // );
        // $post->user()->attach($request->user());
        // return new PostResource($post);

        $post = $request->user()->posts()->create($request->only('body'));

        //return $post; //user_id
        return  new PostResource($post);
    }
}
