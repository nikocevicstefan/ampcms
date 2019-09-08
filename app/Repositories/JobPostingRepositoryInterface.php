<?php

namespace App\Repositories;

interface JobPostingRepositoryInterface{
	public function all();

	public function create($data);

	public function find($data);

	public function findById($id);

	public function update($id, $data);

	public function delete($id);

	public function changeStatus($id);
}
