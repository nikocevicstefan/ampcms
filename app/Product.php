<?php

namespace App;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use UploadTrait;
    protected $guarded = [];

    public function deleteOldImage($id, $imageType){
    	$product = self::findOrFail($id);
    	$filePath = '/img/product_images/'.$product->$imageType;

    	Storage::disk('public')->delete($filePath);
    }
}
