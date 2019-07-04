<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request([
            'cover_photo',
            'alt_tag',
            'title',
            'introductory_content',
            'main_content',
            'tags',
            'thumbnail']);
           /* ->validate([
            'author_id' => 'required',
            'title' => 'required',
            'introductory_content' => 'required',
            'main_content' => 'required',
            'cover_photo' => 'required',
            'alt_tag' => 'required',
            'thumbnail' => 'required',
            'tags' => 'required'
        ]);*/
        $post = Post::create($attributes);
        return redirect('/admin/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.post.editPost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        $attributes = request([
            'cover_photo',
            'alt_tag',
            'title',
            'introductory_content',
            'main_content',
            'tags',
            'thumbnail']);

        $post->update($attributes);
        return redirect('/admin/posts');
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
        return redirect('/admin/posts');
    }
}
