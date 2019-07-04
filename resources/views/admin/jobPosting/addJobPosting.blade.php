@extends('admin.layout')

@section('title', 'Add a Job Posting')
@section('description', 'add job posting content')
@section('content')

    <form method="post" action="/admin/job-postings">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="job_title">Job Title</label>
            <input type="text" class="form-control" name="job_title" id="job_title"
                   placeholder="Enter Job Title">
        </div>
        <div class="form-group">
            <label for="job_description">Job Description</label>
            <textarea class="form-control" id="job_description" name="job_description"
                      placeholder="Enter Job Description"></textarea>
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
            <label for="beginning_date">Beginning Date</label>
            <input type="date" id="beginning_date" name="beginning_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="ending_date">Ending Date</label>
            <input type="date" id="ending_date" name="ending_date" class="form-control">
        </div>
        <!-- /.box-body -->
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>

@endsection
