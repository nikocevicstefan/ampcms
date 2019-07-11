<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.index', compact('users'));
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
            'email' ,
            'profile_photo',
            'is_admin'
        ]);
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
}
