<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $guarded = [];

    public function hasExpired(){
        if($this->ending_date < now()){
            $this->update(['status' => false]);
            return true;
        }
        return false;
    }
}
