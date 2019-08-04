@extends('admin.layout')
@section('title', 'Edit Product')
@section('content')
    <form method="post" action="/admin/products/{{$product->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group {{$errors->has('name')? 'has-error' : ''}}">
            <label for="name">@lang('product.name')</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="{{__('Enter Product Name')}}" value="{{$product->name}}">
        </div>
        <div class="form-group {{$errors->has('short_description')? 'has-error' : ''}}">
            <label for="short_description">@lang('product.shortDesc')</label>
            <input type="text" class="form-control" name="short_description" id="short_description"
                   placeholder="{{__('Enter Product Short Description')}}" value="{{$product->short_description}}">
        </div>
        <div class="form-group {{$errors->has('intro_text')? 'has-error' : ''}}">
            <label for="intro_text">@lang('product.introText')</label>
            <input type="text" class="form-control" name="intro_text" id="intro_text"
                   placeholder="{{__('Enter Product Intro Text')}}" value="{{$product->intro_text}}">
        </div>
        <div class="form-group {{$errors->has('main_text')? 'has-error' : ''}}">
            <label for="main_text">@lang('product.mainText')</label>
            <textarea class="form-control" id="main_text" name="main_text"
                      placeholder="{{__('Enter Product Main Description')}}">{{$product->main_text}}</textarea>
        </div>
        <div class="form-group {{$errors->has('cover_image')? 'has-error' : ''}}">
            <label for="cover_image">@lang('product.coverImage')</label>
            <input type="file" id="cover_image" name="cover_image" class="form-control"
                   value="{{$product->cover_image}}">
        </div>
        <div class="form-group {{$errors->has('alt_tag')? 'has-error' : ''}}">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag" value="{{$product->alt_tag}}">
        </div>
        <div class="form-group {{$errors->has('thumbnail')? 'has-error' : ''}}">
            <label for="thumbnail">@lang('product.thumbnail')</label>
            <input type="file" id="thumbnail" name="thumbnail" class="form-control"
                   value="{{$product->thumbnail}}">
        </div>
        <!-- /.box-body -->
        <button type="submit" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
        <a type="button" class="btn btn-danger"  data-toggle="modal" data-target="#cancelModal" data-url="/admin/products">Close</a>

    </form>

    @include('admin.partials.textEditor')
    @include('admin.confirmAndProceed')
    @include('admin.errors')
@endsection
