@extends('admin.layout')
@section('title', 'User Profile')
@section('page_description', 'User Data')

@section('content')
    <div class="profile-container">
        <?php $userPhoto = 'img/profile_photos/' . auth()->user()->profile_photo?>
        <img src="{{asset($userPhoto)}}" alt="Profile Photo" style="width:100%">
        <h1>{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</h1>
        <p class="title">{{auth()->user()->job_title}}</p>
        <p>{{auth()->user()->username}}</p>
        <p>
            <button type="button" data-toggle="modal" data-target="#change-photo-modal">Change Photo</button>
        </p>
        <p>
            <button type="button" data-toggle="modal" data-target="#change-password-modal">Change Password</button>
        </p>
    </div>

    {{--Change Password Modal--}}
    <div class="modal change-password-modal" tabindex="-1" role="dialog" id="change-password-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
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
                            <label for="current-password" class="col-sm-4 control-label">Current Password</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="password" class="form-control" id="current-password"
                                           name="current-password" placeholder="Password">
                                </div>
                            </div>
                            <label for="password" class="col-sm-4 control-label">New Password</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                </div>
                            </div>
                            <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
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

    {{--Change Profile Photo Modal--}}
    <div class="modal" tabindex="-1" role="dialog" id="change-photo-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-change-photo" role="form" method="POST"
                          action="/admin/users/{{auth()->user()->id}}/change-photo" novalidate class="form-horizontal"
                          enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="col-md-12">
                            <label for="current-password" class="col-sm-4 control-label">Profile Photo</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input id="profile_photo" type="file"
                                           class="form-control @error('profile_photo') is-invalid @enderror"
                                           name="profile_photo" value="{{ old('profile_photo') }}" required
                                           autocomplete="profile_photo">
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
    @include('errors')
@endsection
