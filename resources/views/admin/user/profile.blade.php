@extends('admin.layout')
@section('title', 'User Profile')
@section('page_description', 'User Data')

@section('content')

    <div class="profile-container">
        <?php $userImage = 'img/profile_images/' . auth()->user()->profile_image?>
        <img src="{{asset($userImage)}}" alt="Profile Image" style="width:100%">
        <h1>{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</h1>
        <p class="title">{{auth()->user()->job_title}}</p>
        <p>{{auth()->user()->username}}</p>
        <p>
            <button type="button" data-toggle="modal" data-target="#change-image-modal">{{__('Change Image')}}</button>
        </p>
        <p>
            <button type="button" data-toggle="modal" data-target="#change-password-modal">{{__('Change Password')}}</button>
        </p>
    </div>

    {{--Change Password Modal--}}
    <div class="modal change-password-modal" tabindex="-1" role="dialog" id="change-password-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Change Password')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-change-password" role="form" method="POST"
                          action="/admin/users/{{auth()->user()->id}}/change-password" novalidate
                          class="form-horizontal">
                        @method('PATCH')
                        @csrf
                        <div class="col-md-12">
                            <label for="current_password" class="col-sm-4 control-label">{{__('Current Password')}}</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="password" class="form-control" id="current-password"
                                           name="current-password" placeholder="Password">
                                </div>
                            </div>
                            <label for="password" class="col-sm-4 control-label">{{__('New Password')}}</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                </div>
                            </div>
                            <label for="password_confirmation" class="col-sm-4 control-label">{{__('Re-enter Password')}}</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" placeholder="Re-enter Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-8 col-sm-4">
                                <button type="submit" class="btn btn-danger">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Change Profile Image Modal--}}
    <div class="modal" tabindex="-1" role="dialog" id="change-image-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-change-image" role="form" method="POST"
                          action="/admin/users/{{auth()->user()->id}}/change-image" novalidate class="form-horizontal"
                          enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="col-md-12">
                            <label for="current-password" class="col-sm-4 control-label">Profile Image</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input id="profile_image" type="file"
                                           class="form-control @error('profile_image') is-invalid @enderror"
                                           name="profile_image" value="{{ old('profile_image') }}" required
                                           autocomplete="profile_image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-8 col-sm-4">
                                <button type="submit" class="btn btn-danger">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.errors')
    @include('admin.success')
    @include('admin.warning')

@endsection
