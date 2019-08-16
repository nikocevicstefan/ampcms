<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserImageChangeRequest;

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
    public function store(UserStoreRequest $request){
        $attributes = $request->validated();

        $attributes['profile_image'] = $this->getImagePath(request('first_name'));

        $attributes['password'] = Hash::make(request('password'));

        User::create($attributes);

        return redirect('/admin/users')->with('success', __('User Successfully Added'));
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
            return back()->with('success', __('Password changed successfully'));
        }

        return back()->with('warning', __('Password change failed'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeImage(User $user, UserImageChangeRequest $request){
        $oldImage = $user->profile_image;

        $request->validated();

        $attributes['profile_image'] = $this->getImagePath($user->first_name);
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
        $image = request()->file('profile_image');
        $folder = '/img/profile_images/';
        $filePath = $imageName. '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $imageName);

        return $filePath;
    }

    protected function destroy(User $user){
        if(auth()->user()->id === $user->id){
            return back()->with('warning', __('Cant Delete own profile!'));
        }
        $user->delete();
        return redirect()->back()->with('success', __('User Successfully Deleted'));
    }
}
