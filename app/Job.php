<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function employees(){
        return $this->hasMany(User::class);
    }
}
