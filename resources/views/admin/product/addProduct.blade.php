@extends('admin.layout')
@section('content')
    <form method="post" action="/admin/products" enctype="multipart/form-data">
        @csrf
        <div class="form-group {{$errors->has('name')? 'has-error' : ''}}">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="Enter Product Name" value="{{old('name')}}">
        </div>
        <div class="form-group {{$errors->has('short_description')? 'has-error' : ''}}">
            <label for="short_description">Short Description</label>
            <input type="text" class="form-control" name="short_description" id="short_description"
                   placeholder="Enter Product Short Description" value="{{old('short_description')}}">
        </div>
        <div class="form-group {{$errors->has('intro_text')? 'has-error' : ''}}">
            <label for="intro_text">Intro Text</label>
            <input type="text" class="form-control" name="intro_text" id="intro_text"
                   placeholder="Enter Product Intro Text" value="{{old('intro_text')}}">
        </div>
        <div class="form-group {{$errors->has('main_text')? 'has-error' : ''}}">
            <label for="summary-ckeditor">Main Text</label>
            <textarea class="form-control" name="main_text"
                      placeholder="Enter Product Main Description">{{old('main_text')}}</textarea>
        </div>
        <div class="form-group {{$errors->has('cover_image')? 'has-error' : ''}}">
            <label for="cover_image">Cover Image</label>
            <input type="file" id="cover_image" name="cover_image" class="form-control" value="{{old('cover_image')}}">
        </div>
        <div class="form-group {{$errors->has('alt_tag')? 'has-error' : ''}}">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag" value="{{old('alt_tag')}}">
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" class="form-control" value="{{old('thumbnail')}}">
        </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </form>


    @include('admin.partials.textEditor')
    @include('admin.errors')

@endsection
