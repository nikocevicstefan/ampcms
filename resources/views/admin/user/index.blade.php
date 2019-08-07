@extends('admin.layout')

@section('title', __('sentence.users'))
@section('page_description' , __('List of all users'))

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
                            <input class="form-control mr-sm-2" type="text" placeholder="Search by name" aria-label="Search"
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
                    <div class="col-sm-12 col-md-12 col-lg-6 add-button">
                        <a class="btn btn-primary" href="/admin/users/create"><span><i
                                    class="fa fa-plus"></i></span>@lang('user.addUser')
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
                                >@lang('user.id')
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                >@lang('user.photo')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">
                                    @lang('user.name')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    @lang('user.job')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >@lang('user.username')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    @lang('user.role')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    @lang('sentence.delete')
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$user->id}}</td>
                                    <td style="width: 5%"><img src="/img/profile_images/{{$user->profile_image}}" alt=""
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
                                        <a href="#" title="Delete" class="btn btn-xs btn-danger"
                                           data-toggle="modal"
                                           data-target="#deleteModal"
                                           data-id="{{ $user->id }}"
                                           data-route="{{Route::currentRouteName()}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">@lang('user.id')</th>
                                <th rowspan="1" colspan="1">@lang('user.photo')</th>
                                <th rowspan="1" colspan="1">@lang('user.name')</th>
                                <th rowspan="1" colspan="1">@lang('user.job')</th>
                                <th rowspan="1" colspan="1">@lang('user.username')</th>
                                <th rowspan="1" colspan="1">@lang('user.role')</th>
                                <th rowspan="1" colspan="1">@lang('sentence.delete')</th>
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
    @include('admin.delete')
    @include('admin.warning')
@endsection
