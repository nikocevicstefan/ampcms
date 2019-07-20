@extends('admin.layout')
@section('content')
    <form method="post" action="/admin/posts">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   placeholder="Enter Post Title">
        </div>
        <div class="form-group">
            <label for="introductory_content">Intro Content</label>
            <input type="text" class="form-control" name="introductory_content" id="introductory_content"
                   placeholder="Enter Post Intro Content">
        </div>
        <div class="form-group">
            <label for="main_content">Main Content</label>
            <textarea class="form-control" id="main_content" name="main_content"
                      placeholder="Enter Post Main Content"></textarea>
        </div>
        <div class="form-group">
            <label for="cover_photo">Cover Photo</label>
            <input type="text" id="cover_photo" name="cover_photo" class="form-control">
        </div>
        <div class="form-group">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag">
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="text" id="thumbnail" name="thumbnail" class="form-control">
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" id="tags" placeholder="alt tag" name="tags">
        </div>
        <!-- /.box-body -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>

    @include('admin.errors')


@endsection
