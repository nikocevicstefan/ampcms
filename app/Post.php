<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;


class Post extends Model
{
    protected $guarded = [];

    use UploadTrait;

    public function author(){
        return $this->belongsTo(User::class);
    }

    
}
