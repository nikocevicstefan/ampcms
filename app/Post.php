<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;



class Post extends Model
{
    protected $guarded = [];

    use UploadTrait;

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function deleteOldImage($id){
    	$post = self::findOrFail($id);
    	$filePath = '/img/post_images/'.$post->cover_image;
    	Storage::disk('public')->delete($filePath);
    }
}
