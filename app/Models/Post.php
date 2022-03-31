<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    const MAX_LIKES =5;
    
    protected $fillable = [
        'body'
    ];

    public function likesRemainingFor(User $user){

        return self::MAX_LIKES -$this->likes->where('user_id',$user->id)->count();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(){

        return $this->morphMany(Like::class,'likeable');
    }
    public function likers(){

        return $this->hasManyThrough(
        User::class,
        Like::class,
        'likeable_id',
        'id',
        'id',
        'user_id'
    )->where('likeable_type',Post::class)
     ->groupBy('likes.user_id','user_id','likeable_id');
    }
}
