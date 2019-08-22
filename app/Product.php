<?php

namespace App;
use App\Traits\UploadTrait;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use UploadTrait;
    protected $guarded = [];
}
