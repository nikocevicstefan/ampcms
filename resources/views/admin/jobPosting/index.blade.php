@extends('admin.layout')

@section('title', 'Job Postings')
@section('page_description')
{{__('List of all Job Postings')}}
@endsection

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
                            <input class="form-control mr-sm-2" type="text" placeholder="Search by title" aria-label="Search"
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
                    <div class="col-sm-12 col-md-12 col-lg-6 add-button">
                        <a class="btn btn-primary" href="/admin/job-postings/create"> <span><i
                                    class="fa fa-plus"></i></span>@lang('jobPosting.addPosting')
                        </a>
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
                                >@lang('jobPosting.id')
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                >@lang('jobPosting.title')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    @lang('jobPosting.beginningDate')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >@lang('jobPosting.endingDate')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >@lang('sentence.edit')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >Status
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >@lang('sentence.delete')
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
                                    <td><a href="/admin/job-postings/{{$jobPosting->id}}" class="btn btn-xs btn-primary"> <i class="fa fa-edit"></i>
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
                                        <a href="#" title="Delete" class="btn btn-xs btn-danger"
                                           data-toggle="modal"
                                           data-target="#deleteModal"
                                           data-id="{{ $jobPosting->id }}"
                                           data-route="{{Route::currentRouteName()}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">@lang('jobPosting.id')</th>
                                <th rowspan="1" colspan="1">@lang('jobPosting.title')</th>
                                <th rowspan="1" colspan="1">@lang('jobPosting.beginningDate')</th>
                                <th rowspan="1" colspan="1">@lang('jobPosting.endingDate')</th>
                                <th rowspan="1" colspan="1">@lang('sentence.edit')</th>
                                <th rowspan="1" colspan="1">Status</th>
                                <th rowspan="1" colspan="1">@lang('sentence.delete')</th>
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
    </div>
    @include('admin.delete')
@endsection
