<?php

namespace App\Repositories;

interface PostRepositoryInterface{
	public function all();

	public function create($data);

	public function update($id, $data);

	public function find($data);

	public function findById($id);

	public function delete($id);

	public function changeStatus($id);

}