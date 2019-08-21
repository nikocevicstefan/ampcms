<?php

namespace App\Repositories;

interface ProductRepositoryInterface{
	public function all();

	public function create($data);

	public function update($product, $data);

	public function find($data);

	public function delete($product);

	public function changeStatus($product);

}