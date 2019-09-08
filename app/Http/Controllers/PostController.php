<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\ParseTextEditorContentTrait;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepositoryInterface;



class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $postRepository;
    protected $post;

    public function __construct(PostRepositoryInterface $posts){
        $this->postRepository = $posts;
        $this->post = new Post;
    }

    public function index()
    {
        $posts = $this->postRepository->all();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.addPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {   
        $attributes = $request->validated();
        $attributes['cover_image'] = $this->post->nameFile('post','cover_image');
        $attributes['author_id'] = auth()->id();
        $attributes['locale'] = session('locale');

        $this->postRepository->create($attributes);
        return redirect('/admin/posts')->with('success', __('Post Successfully Added!'));
    }

    public function search()
    {
        $postTitle = request('search_string');
        $posts = $this->postRepository->find($postTitle);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findById($id);
        return view('admin.post.editPost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update($id, PostUpdateRequest $request)
    {
        $attributes = $request->validated();

        if($request->cover_image){
            $this->post->deleteOldImage($id);

            $attributes['cover_image'] = $this->post->nameFile('post','cover_image');
        }
        
        $this->postRepository->update($id, $attributes);
        return redirect('/admin/posts')->with('success',__('Post Successfully Updated'));
    }

    public function status($id)
    {
    
        $this->postRepository->changeStatus($id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return redirect('/admin/posts')->with('success', __('Post Successfully Deleted'));
    }

}
