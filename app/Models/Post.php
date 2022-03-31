<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

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
    )->where('likeable_type',Post::class);
    }
}
