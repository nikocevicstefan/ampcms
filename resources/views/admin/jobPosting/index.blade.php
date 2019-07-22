@extends('admin.layout')

@section('title', 'Products')
@section('page_description', 'List of all products')

@section('content')
    @include('admin.success')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12" style="text-align: center">
                        <form class="form-inline md-form mr-auto mb-4" action="/admin/job-postings/search"
                              method="POST">
                            @csrf
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"
                                   name="search_string">
                            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: left">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {{$jobPostings->onEachSide(4)->links('pagination.small')}}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: right">
                        <button class="btn btn-primary" data-target="#add-job-posting-modal" data-toggle="modal"> <span><i
                                    class="fa fa-plus"></i></span> Add Posting
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                >ID
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                >Title
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    Beginning Date
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >Ending Date
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >Edit
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >Posting Status
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobPostings as $jobPosting)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$jobPosting->id}}</td>
                                    <td>{{$jobPosting->title}}</td>
                                    <td>{{$jobPosting->beginning_date}}</td>
                                    <td>{{$jobPosting->ending_date}}</td>
                                    <td><a href="/admin/job-postings/{{$jobPosting->id}}"> <i class="fa fa-edit"></i>
                                        </a></td>
                                    <td>@if($jobPosting->hasExpired())
                                            <span class="label label-default">Expired</span>
                                        @else
                                            @if($jobPosting->status == 0)
                                                <a href="/admin/job-postings/{{$jobPosting->id}}/status"
                                                   class="btn btn-xs btn-warning">Inactive</a>
                                            @else
                                                <a href="/admin/job-postings/{{$jobPosting->id}}/status"
                                                   class="btn btn-xs btn-success">Active</a>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <form action="/admin/job-postings/{{$jobPosting->id}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Title</th>
                                <th rowspan="1" colspan="1">Beginning Date</th>
                                <th rowspan="1" colspan="1">Ending Date</th>
                                <th rowspan="1" colspan="1">Edit</th>
                                <th rowspan="1" colspan="1">Posting Status</th>
                                <th rowspan="1" colspan="1">Delete</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {{$jobPostings->onEachSide(4)->links('pagination.small')}}
                        </div>
                    </div>
                    <div class="col-sm-8" style="text-align: right">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                            Showing {{$jobPostings->firstItem()}} - {{$jobPostings->lastItem()}}
                            of {{$jobPostings->total()}} entries
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        @include('admin.jobPosting.addJobPosting')
    </div>
@endsection
