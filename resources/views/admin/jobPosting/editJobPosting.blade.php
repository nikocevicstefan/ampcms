@extends('admin.layout')

@section('title', 'Add a Job Posting')
@section('description', 'edit job posting content')
@section('content')

    <form method="post" action="/admin/job-postings/{{$jobPosting->id}}" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="form-group {{$errors->has('title')? 'has-error' : ''}}">
            <label for="title">@lang('jobPosting.title')</label>
            <input type="text" class="form-control" id="title" name="title"
                   placeholder="{{__('Enter Title')}}" value="{{$jobPosting->title}}">
        </div>
        <div class="form-group {{$errors->has('job_title')? 'has-error' : ''}}">
            <label for="job_title">@lang('jobPosting.jobTitle')</label>
            <input type="text" class="form-control" name="job_title" id="job_title"
                   placeholder="{{__('Enter Job Title')}}" value="{{$jobPosting->job_title}}">
        </div>
        <div class="form-group {{$errors->has('job_description')? 'has-error' : ''}}">
            <label for="job_description">@lang('jobPosting.jobDescription')</label>
            <textarea class="form-control" id="job_description" name="job_description"
                      placeholder="{{__('Enter Job Description')}}">{{$jobPosting->job_description}}</textarea>
        </div>
        <div class="container">
            <img src="/img/job_posting_images/{{$jobPosting->cover_image}}" alt="" style="width: 3%">
        </div>
        <div class="form-group {{$errors->has('cover_image')? 'has-error' : ''}}">
            <label for="cover_image">@lang('jobPosting.coverImage')</label>
            <input type="file" id="cover_image" name="cover_image" class="form-control"
                   value="{{$jobPosting->cover_image}}">
        </div>
        <div class="form-group {{$errors->has('alt_tag')? 'has-error' : ''}}">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag" value="{{$jobPosting->alt_tag}}">
        </div>
        <div class="form-group {{$errors->has('beginning_date')? 'has-error' : ''}}">
            <label for="beginning_date">@lang('jobPosting.beginningDate')</label>
            <input type="date" id="beginning_date" name="beginning_date" class="form-control"
                   value="{{$jobPosting->beginning_date}}">
        </div>
        <div class="form-group {{$errors->has('ending_date')? 'has-error' : ''}}">
            <label for="ending_date">@lang('jobPosting.endingDate')</label>
            <input type="date" id="ending_date" name="ending_date" class="form-control"
                   value="{{$jobPosting->ending_date}}">
        </div>
        <!-- /.box-body -->
        <button type="submit" class="btn btn-primary" data-dismiss="modal">@lang('sentence.save')</button>
        <a type="button" class="btn btn-danger"  data-toggle="modal" data-target="#cancelModal" data-url="/admin/job-postings">@lang('sentence.close')</a>
    </form>
    @include('admin.partials.textEditor')
    @include('admin.confirmAndProceed')
    @include('admin.errors')
@endsection
