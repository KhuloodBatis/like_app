<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;


    protected $fillable =[
       'user_id'
    ];
    public function likeable(){

        return $this->morphTo();
    }

    public function avatar(){

        return 'https://www.pngegg.com/ar/png-wpleh'.md5($this->email);
    }
}
