<?php
namespace App\Repositories;
use App\User;

class EloquentUserRepository implements UserRepositoryInterface {

	public function all(){
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return $users;
	}

	public function create($data){
		$user = User::create($data);
		return $user;
	}

	public function find($data){
		$users = User::where('first_name', 'LIKE', '%'.$data.'%')->orWhere('last_name', 'LIKE', '%'.$data.'%')->paginate(10);
		return $users;
	}

	public function delete($user){
		$user->delete();
	}

	public function switchRole($user){
		$user->update();
	}

	
}
