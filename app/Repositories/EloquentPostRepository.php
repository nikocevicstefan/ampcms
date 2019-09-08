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


	public function update($id, $data){
		$post = $this->findById($id);
		$post->update($data);
		return $post;
	}

	public function find($data){
		$posts = Post::where('title', 'LIKE', '%' . $data . '%')->paginate(10);
		return $posts;
	}

	public function findById($id){
		return Post::findOrFail($id);
	}

	public function delete($id){
		$post = $this->findById($id);
		$post->delete();
	}

	public function changeStatus($id)
	{
		$post = $this->findById($id);
		$post->is_published = !$post->is_published;
		$post->update();
	}
	
}
