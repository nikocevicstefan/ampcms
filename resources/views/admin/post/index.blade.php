@extends('admin.layout')

@section('title', 'Posts')
@section('page_description', 'List of all posts')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12" style="text-align: center">
                        <form class="form-inline md-form mr-auto mb-4" action="/admin/posts/search" method="POST">
                            @csrf
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search_string">
                            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="row" style="padding: 0">
                    <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: left">
                            {{$posts->onEachSide(4)->links('pagination.small')}}
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-post-modal"><span><i class="fa fa-plus"></i></span>Add Post</button>
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
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    Title
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                >Date Created
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Author
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Edit
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Status
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->author->first_name. ' '.$post->author->last_name}}</td>
                                    <td><a href="/admin/posts/{{$post->id}}"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        @if( $post->is_published == 0)
                                            <a href="posts/{{$post->id}}/status"><button class="btn btn-xs btn-warning">Draft</button></a>
                                        @else
                                            <a href="posts/{{$post->id}}/status"><button class="btn btn-xs btn-success">Posted</button></a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="/admin/posts/{{$post->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
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
                                <th rowspan="1" colspan="1">Date Created</th>
                                <th rowspan="1" colspan="1">Author</th>
                                <th rowspan="1" colspan="1">Edit</th>
                                <th rowspan="1" colspan="1">Status</th>
                                <th rowspan="1" colspan="1">Delete</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {{$posts->onEachSide(4)->links('pagination.small')}}
                        </div>
                    </div>
                    <div class="col-sm-8" style="text-align: right">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                            Showing {{$posts->firstItem()}} - {{$posts->lastItem()}}
                            of {{$posts->total()}} entries
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.post.addPost')
        <!-- /.box-body -->
    </div>
@endsection
