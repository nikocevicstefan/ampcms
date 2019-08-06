<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use UploadTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user){
        return view('admin.user.profile', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.user.addUser');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(){
        $attributes = request()->validate([
            'first_name' => 'required|alpha|min:2|max:200',
            'last_name' => 'required|alpha|min:2|max:200',
            'job_title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'username' => 'unique:users|alpha_num|required|min:2|max:200',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'is_admin' => 'required|bool'
        ]);

        $filePath = $this->getImagePath(request('first_name'));
        $attributes['profile_image'] = $filePath;

        $attributes['password'] = Hash::make(request('password'));

        $user = User::create($attributes);

        return redirect('/admin/users')->with('success', 'User Successfully Added');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function role(User $user){
        if($user->id === auth()->user()->id){
            return back()->with('warning', 'Can\'t change own role');
        }
        $user->is_admin = !$user->is_admin;
        $user->update();
        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(){
        $name = request('search_string');
        $users = User::where('first_name', 'LIKE', '%'.$name.'%')->orWhere('last_name', 'LIKE', '%'.$name.'%')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.user.editUser', compact('user'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(User $user){
        if(Hash::check(request('current-password'),  $user->password) && request('password') == request('password_confirmation')){
            $user->password = Hash::make(request('password'));
            $user->update();
            return back()->with('success', 'Password changed successfully');
        }

        return back()->with('warning', 'Password change failed');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeImage(User $user){
        $oldImage = $user->profile_image;

        $filePath = $this->getImagePath($user->first_name);
        $attributes['profile_image'] = $filePath;
        $user->update($attributes);

        if($oldImage != 'avatar.png')
        {   $filePath = 'img/profile_images/'. $oldImage;
            Storage::disk('public')->delete($filePath);
        }
        return back();
    }


    /**
     * Take user first name and generate image name with it
     * @param $name
     * Return generated image name to be stored in the database
     * @return string
     */
    protected function getImagePath($name){

        $imageName = $name.'_'.time();
        $validateImage = request()->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $image = request()->file('profile_image');
        $folder = '/img/profile_images/';
        $filePath = $imageName. '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $imageName);

        return $filePath;
    }
}
