@extends('admin.layout')
@section('title', 'User')
@section('page_description', 'Edit User')
@section('content')
    <form method="POST" action="/admin/users/{{$user->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group row">
            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

            <div class="col-md-6">
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                       name="first_name" value="{{$user->first_name}}" required autocomplete="first_name" autofocus>

                @error('first_name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                       name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus>

                @error('last_name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="job_title" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>

            <div class="col-md-6">
                <input id="job_title" type="text" class="form-control @error('job_title') is-invalid @enderror"
                       name="job_title" value="{{ $user->job_title }}" required autocomplete="job_title" autofocus>

                @error('job_title')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                       name="username" value="{{ $user->username }}" required autocomplete="username">

                @error('username')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>

            <div class="col-md-6">
                <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror"
                       name="profile_image" value="{{ $user->profile_image }}" required autocomplete="profile_image">

                @if (auth()->user()->profile_image)
                    <code>{{ auth()->user()->profile_image}}</code>
                @endif
                @error('profile_image')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('Is Admin?') }}</label>
            <div class="col-md-6">
                <select name="is_admin" id="is_admin" class="form-control">
                    <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                    <option value="0" {{ $user->is_admin ? '' : 'selected' }}>Moderator</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4" style="text-align: right">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-warning" data-target="change-password-modal" data-toggle="modal">Change Password</button>
                <button type="submit" class="btn btn-primary">
                    {{ __('Add user') }}
                </button>
            </div>
        </div>
    </form>
@endsection
