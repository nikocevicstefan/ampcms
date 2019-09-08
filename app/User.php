<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\UploadTrait;

class User extends Authenticatable
{
    use Notifiable;
    use UploadTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class, 'author_id');
    }

    public function allAuthorsId(){
        return $this->all()->pluck('id')->toArray();
    }

    public function deleteOldImage($id){
        $user = self::findOrFail($id);

        $filePath = '/img/profile_images/' . $user->profile_image;
        Storage::disk('public')->delete($filePath);
    }
}
