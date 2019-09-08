<?php

namespace App;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;


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

    public function deleteOldImage($id){
    	$jobPosting = self::findOrFail($id);
    	$filePath = '/img/job_posting_images/'. $this->cover_image;

    	Storage::disk('public')->delete($filePath);
    }
}
