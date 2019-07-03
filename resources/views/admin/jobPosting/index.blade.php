@extends('admin.layout')

@section('title', 'Products')
@section('page_description', 'List of all products')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_length" id="example1_length">
                            <label>Show
                                <select name="example1_length"
                                        aria-controls="example1"
                                        class="form-control input-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                                                                 class="form-control input-sm"
                                                                                                 placeholder=""
                                                                                                 aria-controls="example1"></label>
                        </div>
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
                                >Photo
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                >Title
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                >Job Title
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
                                >Posting Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobPostings as $jobPosting)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$jobPosting->id}}</td>
                                    <td>{{$jobPosting->cover_photo}}</td>
                                    <td>{{$jobPosting->title}}</td>
                                    <td>{{$jobPosting->job_title}}</td>
                                    <td>{{$jobPosting->beginning_date}}</td>
                                    <td>{{$jobPosting->ending_date}}</td>
                                    <td>{{( $jobPosting->status == 0)? 'Inactive': 'Active'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Photo</th>
                                <th rowspan="1" colspan="1">Title</th>
                                <th rowspan="1" colspan="1">Job Title</th>
                                <th rowspan="1" colspan="1">Beginning Date</th>
                                <th rowspan="1" colspan="1">Ending Date</th>
                                <th rowspan="1" colspan="1">Posting Status</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                            Showing {{$jobPostings->firstItem()}} - {{$jobPostings->lastItem()}}
                            of {{$jobPostings->total()}} entries
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {{$jobPostings->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
