<?php

namespace App\Repositories;

use App\Product;

class EloquentProductRepository implements ProductRepositoryInterface{
	public function all(){
		$products =  Product::orderBy('created_at', 'desc')->paginate(10);
		return $products;
	}

	public function find($data){
		$products =  Product::where('name', 'LIKE', '%'.$data.'%')->paginate(10);
		return $products;
	}

	public function findById($id){
		return Product::findOrFail($id);
	}

	public function update($id, $data){
		$product = $this->findById($id);
		$product->update($data);
	}

	public function create($data)
	{
		$product = Product::create($data);
		return $product;
	}

	public function delete($id){
		$product = $this->findById($id);
		$product->delete();
	}

	public function changeStatus($id)
	{
		$product = $this->findById($id);
		$product->status = !$product->status;
		$product->update();
	}
}