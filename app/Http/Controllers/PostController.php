<?php

namespace App\Http\Controllers;

use App\Post;
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
            'title' => 'required|min:3|alpha_dash',
            'introductory_content' => 'required|min:5',
            'main_content' => 'required',
            'cover_photo' => 'required',
            'alt_tag' => 'required|min:2',
            'thumbnail' => 'required',
            'tags' => 'required'
        ]);

        $coverPhotoPath = $this->getPhotoPath('post', 'cover_photo');
        $thumbnailPath = $this->getPhotoPath('post', 'thumbnail');
        $attributes['cover_photo'] = $coverPhotoPath;
        $attributes['thumbnail'] = $thumbnailPath;

        $attributes['author_id'] = auth()->id();
        $post = Post::create($attributes);
        return redirect('/admin/posts')->with('success', 'Post Successfully Added!');
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
            'title' => 'required|min:3|alpha_dash',
            'introductory_content' => 'required|min:5',
            'main_content' => 'required',
            'cover_photo' => 'required',
            'alt_tag' => 'required|min:2',
            'thumbnail' => 'required',
            'tags' => 'required'
        ]);

        $filePath = 'img/post_photos/';
        $coverPhotoName = $post->cover_photo;
        Storage::disk('public')->delete($filePath . $coverPhotoName);
        $thumbnailName = $post->thumbnail;
        Storage::disk('public')->delete($filePath.$thumbnailName);


        $coverPhotoPath = $this->getPhotoPath('post', 'cover_photo');
        $thumbnailPath = $this->getPhotoPath('post', 'thumbnail');
        $attributes['cover_photo'] = $coverPhotoPath;
        $attributes['thumbnail'] = $thumbnailPath;

        $post->update($attributes);
        return redirect('/admin/posts');
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
        return redirect('/admin/posts')->with('success', 'Post Successfully Deleted');
    }

    protected function getPhotoPath($name, $request){

        $photoName = $name.'_'.$request.'_'.time();
        $validatePhoto = request()->validate([
            $request => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $photo = request()->file($request);
        $folder = '/img/post_photos/';
        $filePath = $photoName. '.' . $photo->getClientOriginalExtension();
        $this->uploadOne($photo, $folder, 'public', $photoName);

        return $filePath;
    }
}
