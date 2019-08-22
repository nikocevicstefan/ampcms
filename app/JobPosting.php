<?php

namespace App;
use App\Traits\UploadTrait;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
	use UploadTrait;
    protected $guarded = [];

    public function hasExpired(){
        if($this->ending_date < now()){
            $this->update(['status' => false]);
            return true;
        }
        return false;
    }
}
