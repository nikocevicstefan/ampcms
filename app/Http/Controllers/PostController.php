<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\ParseTextEditorContentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    protected $posts;
    protected $postInstance;

    public function __construct(PostRepositoryInterface $posts){
        $this->posts = $posts;
        $this->postInstance = new Post;
    }

    public function index()
    {
        $posts = $this->posts->all();
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
        $attributes['cover_image'] = $this->postInstance->nameFile('post','cover_image');
        $attributes['author_id'] = auth()->id();
        $attributes['locale'] = session('locale');

        $this->posts->create($attributes);
        return redirect('/admin/posts')->with('success', __('Post Successfully Added!'));
    }

    public function search()
    {
        $postTitle = request('search_string');
        $posts = $this->posts->find($postTitle);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.post.editPost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, PostUpdateRequest $request)
    {
        $attributes = $request->validated();

        $filePath = 'img/post_images/';
        if($request->cover_image){
            Storage::disk('public')->delete($filePath . $post->cover_image);

            $attributes['cover_image'] = $this->postInstance->nameFile('post','cover_image');
        }
        
        $this->posts->update($post, $attributes);
        return redirect('/admin/posts')->with('success',__('Post Successfully Updated'));
    }

    public function status(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/admin/posts')->with('success', __('Post Successfully Deleted'));
    }

}
