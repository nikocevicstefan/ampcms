@extends('admin.layout')

@section('title', 'Edit a Post')
@section('description', 'update post content')
@section('content')
    <form method="post" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   placeholder="Enter Post Title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="introductory_content">Intro Content</label>
            <input type="text" class="form-control" name="introductory_content" id="introductory_content"
                   placeholder="Enter Post Intro Content" value="{{$post->introductory_content}}">
        </div>
        <div class="form-group">
            <label for="main_content">Main Content</label>
            <textarea class="form-control" id="main_content" name="main_content"
                      placeholder="Enter Post Main Content">{{$post->main_content}}</textarea>
        </div>
        <div class="form-group">
            <label for="cover_photo">Cover Photo</label>
            <input type="file" id="cover_photo" name="cover_photo" class="form-control" value="{{$post->cover_photo}}">
        </div>
        <div class="form-group">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag" value="{{$post->alt_tag}}">
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" class="form-control" value="{{$post->thumbnail}}">
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" id="tags" placeholder="tags" name="tags" value="{{$post->tags}}">
        </div>
        <!-- /.box-body -->
        <button type="submit" class="btn btn-primary" style="margin-bottom: 1%">Update Post</button>
    </form>

    <form action="/admin/posts/{{$post->id}}" method="post">
        @csrf
        @method('DELETE')
        <div class="form-field">
            <button type="submit" class="btn btn-danger">Delete Post</button>
        </div>
    </form>



@endsection
