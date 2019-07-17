<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function show(User $user){
        return view('admin.user.profile', compact('user'));
    }

    public function create(){
        return view('admin.user.addUser');
    }

    public function store(){
        $attributes = request([
            'first_name',
            'last_name' ,
            'job_title' ,
            'username',
            'is_admin'
        ]);

        $photo = request()->file('profile_photo');
        $photoName = request('first_name').'_'.time();
        $folder = '/img/profile_photos/';
        $filePath = $photoName. '.' . $photo->getClientOriginalExtension();
        $this->uploadOne($photo, $folder, 'public', $photoName);
        $attributes['profile_photo'] = $filePath;

        $attributes['password'] = Hash::make(request('password'));

        $user = User::create($attributes);

        return redirect('/admin/users');
    }

    public function status(User $user){
        $user->is_admin = !$user->is_admin;
        $user->update();
        return back();
    }

    public function search(){
        $name = request('search_string');
        $users = User::where('first_name', 'LIKE', '%'.$name.'%')->orWhere('last_name', 'LIKE', '%'.$name.'%')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.user.editUser', compact('user'));
    }

    public function changePassword(User $user){
        if(Hash::make(request('current-password')) == $user->password && request('password') == request('password_confirmation')){
            $user->password = Hash::make(request('password'));
            $user->update();
            return back();
        }


        return back();
    }
    public function changePhoto(User $user){
        $oldPhoto = $user->profile_photo;

        $photo = request()->file('profile_photo');
        $photoName = $user->first_name.'_'.time();
        $folder = '/img/profile_photos/';
        $filePath = $photoName. '.' . $photo->getClientOriginalExtension();
        $this->uploadOne($photo, $folder, 'public', $photoName);
        $attributes['profile_photo'] = $filePath;
        $user->update($attributes);

        if($oldPhoto != 'avatar.png')
        {   $filePath = 'img/profile_photos/'. $oldPhoto;
            Storage::disk('public')->delete($filePath);
        }
        return back();
    }

}
