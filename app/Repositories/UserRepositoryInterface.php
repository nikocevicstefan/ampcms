<?php

namespace App\Repositories;

interface UserRepositoryInterface{
	public function all();

	public function create($data);

	public function find($data);

	public function delete($user);

	public function switchRole($user);

}