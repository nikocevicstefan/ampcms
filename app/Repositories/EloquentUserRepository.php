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

	public function update($id, $data){
		$user = $this->findById($id);
		$user->update($data);
	}

	public function find($data){
		$users = User::where('first_name', 'LIKE', '%'.$data.'%')->orWhere('last_name', 'LIKE', '%'.$data.'%')->paginate(10);
		return $users;
	}

	public function findById($id){
		return User::findOrFail($id);
	}

	public function delete($id){
		$user = $this->findById($id);
		$user->delete();
	}

	public function switchRole($id){
		$user = $this->findById($id);
        $user->is_admin = !$user->is_admin;
		$user->update();
	}

	
}
