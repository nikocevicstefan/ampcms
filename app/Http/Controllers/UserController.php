<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserImageChangeRequest;
use App\Repositories\UserRepositoryInterface;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use UploadTrait;

    protected $userRepository;
    protected $user;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->userRepository = $users;
        $this->user = new User;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $user = $this->userRepository->findById($id);
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

        $attributes['profile_image'] = $this->user->nameFile('profile','profile_image');

        $attributes['password'] = Hash::make(request('password'));

        $this->userRepository->create($attributes);

        return redirect('/admin/users')->with('success', __('User Successfully Added'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function role($id){
        $user = $this->userRepository->findById($id);
        if($user->id === auth()->user()->id){
            return back()->with('warning', 'Can\'t change own role');
        }
        $this->userRepository->switchRole($id);
        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(){
        $name = request('search_string');
        $users = $this->userRepository->find($name);
        return view('admin.user.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
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
    public function changeImage($id, UserImageChangeRequest $request){
        $user = $this->userRepository->findById($id);
        $request->validated();

        if($user->profile_image != 'avatar.png'){
           $this->user->deleteOldImage($id);
        }

        $attributes['profile_image'] = $this->user->nameFile('profile','profile_image');
        $this->userRepository->update($id, $attributes);

        return back();
    }


    protected function destroy($id){
        $user = $this->userRepository->findById($id);

        if(auth()->user()->id === $user->id){
            return back()->with('warning', __('Cant Delete own profile!'));
        }
        $this->userRepository->delete($id);
        return redirect()->back()->with('success', __('User Successfully Deleted'));
    }
}
