<?php

namespace App\Repositories;

interface PostRepositoryInterface{
	public function all();

	public function create($data);

	public function update($post, $data);

	public function find($data);

	public function delete($user);

	public function changeStatus($post);

}