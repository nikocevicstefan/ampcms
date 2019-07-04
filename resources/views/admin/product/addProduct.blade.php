@extends('admin.layout')

@section('title', 'Add a Product')
@section('description', 'add product content')
@section('content')
    <form method="post" action="/admin/products">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="Enter Product Name">
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <input type="text" class="form-control" name="short_description" id="short_description"
                   placeholder="Enter Product Short Description">
        </div>
        <div class="form-group">
            <label for="long_description">Main Description</label>
            <textarea class="form-control" id="long_description" name="long_description"
                      placeholder="Enter Product Main Description"></textarea>
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
        <!-- /.box-body -->
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>

@endsection
