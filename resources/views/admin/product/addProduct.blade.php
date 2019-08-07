@extends('admin.layout')
@section('content')
    <form method="post" action="/admin/products" enctype="multipart/form-data">
        @csrf
        <div class="form-group {{$errors->has('name')? 'has-error' : ''}}">
            <label for="name">@lang('product.name')</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="{{__('Enter Product Name')}}" value="{{old('name')}}">
        </div>
        <div class="form-group {{$errors->has('short_description')? 'has-error' : ''}}">
            <label for="short_description">@lang('product.shortDesc')</label>
            <input type="text" class="form-control" name="short_description" id="short_description"
                   placeholder="{{__('Enter Product Short Description')}}" value="{{old('short_description')}}">
        </div>
        <div class="form-group {{$errors->has('intro_text')? 'has-error' : ''}}">
            <label for="intro_text">@lang('product.introText')</label>
            <input type="text" class="form-control" name="intro_text" id="intro_text"
                   placeholder="{{__('Enter Product Intro Text')}}" value="{{old('intro_text')}}">
        </div>
        <div class="form-group {{$errors->has('main_text')? 'has-error' : ''}}">
            <label for="summary-ckeditor">@lang('product.mainText')</label>
            <textarea class="form-control" name="main_text"
                      placeholder="{{__('Enter Product Main Description')}}">{{old('main_text')}}</textarea>
        </div>
        <div class="form-group {{$errors->has('cover_image')? 'has-error' : ''}}">
            <label for="cover_image">@lang('product.coverImage')</label>
            <input type="file" id="cover_image" name="cover_image" class="form-control" value="{{old('cover_image')}}">
        </div>
        <div class="form-group {{$errors->has('alt_tag')? 'has-error' : ''}}">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag" value="{{old('alt_tag')}}">
        </div>
        <div class="form-group">
            <label for="thumbnail">@lang('product.thumbnail')</label>
            <input type="file" id="thumbnail" name="thumbnail" class="form-control" value="{{old('thumbnail')}}">
        </div>

        <div class="row">
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary">@lang('sentence.save')</button>
                <a class="btn btn-secondary"  data-toggle="modal" data-target="#cancelModal" data-url="/admin/products">@lang('sentence.close')</a>
            </div>
            <div class="col-md-4 right">
                <?php $localeImage = 'img/flags/' . session('locale') . '.svg'; ?>
                <p>@lang('sentence.language'):<span><img src="{{asset($localeImage)}}" alt="localization image" style="width: 10%"></span></p>
            </div>
        </div>
    </form>


    @include('admin.partials.textEditor')
    @include('admin.confirmAndProceed')
    @include('admin.errors')

@endsection
