<?php
namespace App\Repositories;
use App\Post;

class EloquentPostRepository implements PostRepositoryInterface {

	public function all(){
        $posts =  Post::orderBy('created_at', 'desc')->paginate(10);
        return $posts;
	}

	public function create($data){
		$post = Post::create($data);
		return $post;
	}


	public function update($post, $data){
		$post->update($data);
		return $post;
	}

	public function find($data){
		$posts = Post::where('title', 'LIKE', '%' . $data . '%')->paginate(10);
		return $posts;
	}

	public function delete($user){
		$post->delete();
	}

	public function changeStatus($post)
	{
		$post->update();
	}
	
}
