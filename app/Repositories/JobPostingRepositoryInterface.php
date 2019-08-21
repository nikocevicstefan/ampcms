<?php

namespace App\Repositories;

interface JobPostingRepositoryInterface{
	public function all();

	public function create($data);

	public function find($data);

	public function update($jobPosting, $data);

	public function delete($jobPosting);

	public function changeStatus($jobPosting);
}