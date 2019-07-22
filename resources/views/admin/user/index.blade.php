@extends('admin.layout')

@section('title', 'Users')
@section('page_description', 'List of all users')

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
                        <form class="form-inline md-form mr-auto mb-4" action="/admin/users/search" method="POST">
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
                            {{$users->onEachSide(4)->links('pagination.small')}}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: right ">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-user-modal"><span><i
                                    class="fa fa-plus"></i></span>Add
                            User
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
                                >Photo
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    Company Position
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >Username
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    User Role
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$user->id}}</td>
                                    <td style="width: 5%"><img src="/img/profile_photos/{{$user->profile_photo}}" alt=""
                                                               class="img-circle" style="width: 90%"></td>
                                    <td>{{$user->first_name . ' ' . $user->last_name}}</td>
                                    <td>{{$user->job_title}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>@if( $user->is_admin == 0)
                                            <a href="/admin/users/{{$user->id}}/role" class="btn btn-xs btn-warning">Moderator</a>
                                        @else
                                            <a href="/admin/users/{{$user->id}}/role" class="btn btn-xs btn-success">Administrator</a>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <form action="/admin/job-postings/{{$user->id}}" method="POST">
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
                                <th rowspan="1" colspan="1">Photo</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Company Position</th>
                                <th rowspan="1" colspan="1">Username</th>
                                <th rowspan="1" colspan="1">User Role</th>
                                <th rowspan="1" colspan="1">Delete</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {{$users->onEachSide(4)->links('pagination.small')}}
                        </div>
                    </div>
                    <div class="col-sm-8" style="text-align: right">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                            Showing {{$users->firstItem()}} - {{$users->lastItem()}}
                            of {{$users->total()}} entries
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
