@extends('admin.layout')
@section('content')
<form method="POST" action="/admin/users" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <label for="first_name"
               class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

        <div class="col-md-8">
            <input id="first_name" type="text"
                   class="form-control @error('first_name') is-invalid @enderror"
                   name="first_name" value="{{ old('first_name') }}" required
                   autocomplete="first_name" autofocus>

            @error('first_name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="last_name"
               class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

        <div class="col-md-8">
            <input id="last_name" type="text"
                   class="form-control @error('last_name') is-invalid @enderror"
                   name="last_name" value="{{ old('last_name') }}" required
                   autocomplete="last_name" autofocus>

            @error('last_name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="job_title"
               class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>

        <div class="col-md-8">
            <input id="job_title" type="text"
                   class="form-control @error('job_title') is-invalid @enderror"
                   name="job_title" value="{{ old('job_title') }}" required
                   autocomplete="job_title" autofocus>

            @error('job_title')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="username"
               class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

        <div class="col-md-8">
            <input id="username" type="text"
                   class="form-control @error('username') is-invalid @enderror"
                   name="username" value="{{ old('username') }}" required
                   autocomplete="username">

            @error('username')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password"
               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-8">
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm"
               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-8">
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required
                   autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="profile_photo"
               class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>

        <div class="col-md-8">
            <input id="profile_photo" type="file"
                   class="form-control @error('profile_photo') is-invalid @enderror"
                   name="profile_photo" value="{{ old('profile_photo') }}" required
                   autocomplete="profile_photo">

            @error('profile_photo')
            @if (auth()->user()->profile_photo)
                <code>{{ auth()->user()->profile_photo}}</code>
            @endif
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="is_admin"
               class="col-md-4 col-form-label text-md-right">{{ __('Is Admin?') }}</label>
        <div class="col-md-8">
            <select name="is_admin" id="is_admin" class="form-control">
                <option value="1">Admin</option>
                <option value="0">Moderator</option>
            </select>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
            </button>
        </div>
        <div class="col-md-4" style="text-align: right">
            <button type="submit" class="btn btn-primary">
                {{ __('Add user') }}
            </button>
        </div>
    </div>
</form>
@endsection
