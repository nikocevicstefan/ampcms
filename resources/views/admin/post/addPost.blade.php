@extends('admin.layout')
@section('content')

<form method="post" action="/admin/posts" enctype="multipart/form-data">
    @csrf
    <div class="form-group {{$errors->has('title')? 'has-error' : ''}}">
        <label for="title">@lang('post.title')</label>
        <input type="text" class="form-control" id="title" name="title"
        placeholder="Enter Post Title"
        value="{{old('title')}}">
    </div>
    <div class="form-group {{$errors->has('introductory_content')? 'has-error' : ''}}">
        <label for="introductory_content">@lang('post.introContent')</label>
        <input type="text" class="form-control" name="introductory_content" id="introductory_content"
        placeholder="Enter Post Intro Content" value="{{old('introductory_content')}}">
    </div>
    <div class="form-group {{$errors->has('main_content')? 'has-error' : ''}}">
        <label for="main_content">@lang('post.mainContent')</label>
        <textarea class="form-control" id="main_content" name="main_content"
        placeholder="Enter Post Main Content">{{old('main_content')}}</textarea>
    </div>
    <div class="form-group {{$errors->has('cover_image')? 'has-error' : ''}}">
        <label for="cover_image">@lang('post.coverImage')</label>
        <input type="file" id="cover_image" name="cover_image" class="form-control" value="{{old('cover_image')}}">
    </div>
    <div class="form-group {{$errors->has('alt_tag')? 'has-error' : ''}}">
        <label for="alt_tag">Alt Tag</label>
        <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
        name="alt_tag" value="{{old('alt_tag')}}">
    </div>
    <div class="form-group {{$errors->has('tags')? 'has-error' : ''}}">
        <label for="tags">@lang('post.tags')</label>
        <input type="text" class="form-control" id="tags" placeholder="tags" name="tags" value="{{old('tags')}}">
    </div>
    <!-- /.box-body -->
    <button type="submit" class="btn btn-primary" data-dismiss="modal">@lang('sentence.save')</button>
    <a type="button" class="btn btn-danger"  data-toggle="modal" data-target="#cancelModal" data-url="/admin/posts">@lang('sentence.close')</a>
</form>

@include('admin.partials.textEditor')
@include('admin.confirmAndProceed')
@include('admin.errors')

@endsection
