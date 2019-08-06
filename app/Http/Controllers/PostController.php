<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\ParseTextEditorContentTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
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
    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'introductory_content' => 'required',
            'main_content' => 'required',
            'cover_image' => 'required',
            'alt_tag' => 'required',
            'tags' => 'required'
        ]);

      
        $coverImagePath = $this->getImagePath('post', 'cover_image');
        $attributes['cover_image'] = $coverImagePath;

        $attributes['author_id'] = auth()->id();
        $attributes['locale'] = session('locale');
        Post::create($attributes);
        return redirect('/admin/posts')->with('success', __('Post Successfully Added!'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    public function search()
    {
        $postTitle = request('search_string');
        $posts = Post::where('title', 'LIKE', '%' . $postTitle . '%')->paginate(10);
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
    public function update(Post $post)
    {
        $attributes = request()->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'introductory_content' => 'required',
            'main_content' => 'required',
            'alt_tag' => 'required',
            'tags' => 'required'
        ]);

        $filePath = 'img/post_images/';
        if(request('cover_image')){
            $coverImageName = $post->cover_image;
            Storage::disk('public')->delete($filePath . $coverImageName);

            $coverImagePath = $this->getImagePath('post', 'cover_image');
            $attributes['cover_image'] = $coverImagePath;

        }
       
        $post->update($attributes);
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

    protected function getImagePath($name, $request)
    {

        $imageName = $name . '_' . $request . '_' . time();
        $validateImage = request()->validate([
            $request => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $image = request()->file($request);
        $folder = '/img/post_images/';
        $filePath = $imageName . '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $imageName);

        return $filePath;
    }
}
