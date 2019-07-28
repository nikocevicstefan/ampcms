@extends('admin.layout')
@section('title', 'Edit Product')
@section('content')
    <form method="post" action="/admin/products/{{$product->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group {{$errors->has('name')? 'has-error' : ''}}">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="Enter Product Name" value="{{$product->name}}">
        </div>
        <div class="form-group {{$errors->has('short_description')? 'has-error' : ''}}">
            <label for="short_description">Short Description</label>
            <input type="text" class="form-control" name="short_description" id="short_description"
                   placeholder="Enter Product Short Description" value="{{$product->short_description}}">
        </div>
        <div class="form-group {{$errors->has('intro_text')? 'has-error' : ''}}">
            <label for="intro_text">Short Description</label>
            <input type="text" class="form-control" name="intro_text" id="intro_text"
                   placeholder="Enter Product Intro Text" value="{{$product->intro_text}}">
        </div>
        <div class="form-group {{$errors->has('main_text')? 'has-error' : ''}}">
            <label for="main_text">Main Text</label>
            <textarea class="form-control summernote" id="main_text" name="main_text"
                      placeholder="Enter Product Main Description">{{$product->main_text}}</textarea>
        </div>
        <div class="form-group {{$errors->has('cover_image')? 'has-error' : ''}}">
            <label for="cover_image">Cover Photo</label>
            <input type="file" id="cover_image" name="cover_image" class="form-control"
                   value="{{$product->cover_image}}">
        </div>
        <div class="form-group {{$errors->has('alt_tag')? 'has-error' : ''}}">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag" value="{{$product->alt_tag}}">
        </div>
        <div class="form-group {{$errors->has('thumbnail')? 'has-error' : ''}}">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" class="form-control"
                   value="{{$product->thumbnail}}">
        </div>
        <!-- /.box-body -->
        <button type="submit" class="btn btn-primary">Update Product</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </form>

    @include('admin.errors')

    <script>
        $(document).ready(function () {
            //initialize summernote
            $('.summernote').summernote();
            //assign the variable passed from controller to a JavaScript variable.
            var main_text = {!! json_encode($product->main_text) !!};
            //set the content to summernote using `code` attribute.
            $('.summernote').summernote('code', main_text);
        })
    </script>

@endsection
