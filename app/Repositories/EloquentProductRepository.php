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

	public function update($product, $data){
		$product->update($data);
	}

	public function create($data)
	{
		$product = Product::create($data);
		return $product;
	}

	public function delete($product){
		$product->delete();
	}

	public function changeStatus($post)
	{
		$post->update();
	}
}