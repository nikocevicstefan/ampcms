@extends('admin.layout')
@section('content')
    <form method="POST" action="/admin/users" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="first_name">{{ __('user.firstName') }}
            </label>
            <input id="first_name" type="text"
                   class="form-control {{$errors->has('title') ? 'is-danger': ''}}"
                   name="first_name" value="{{ old('first_name') }}" required
                   autocomplete="first_name"
                   autofocus>
        </div>

        <div class="form-group">
            <label for="last_name">{{ __('user.lastName') }}</label>
            <input id="last_name" type="text"
                   class="form-control @error('last_name') is-invalid @enderror"
                   name="last_name" value="{{ old('last_name') }}" required
                   autocomplete="last_name" autofocus>
        </div>

        <div class="form-group">
            <label for="job_title">{{ __('user.job') }}</label>
            <input id="job_title" type="text"
                   class="form-control @error('job_title') is-invalid @enderror"
                   name="job_title" value="{{ old('job_title') }}" required
                   autocomplete="job_title" autofocus>
        </div>

        <div class="form-group">
            <label for="username">{{ __('user.username') }}</label>
            <input id="username" type="text"
                   class="form-control @error('username') is-invalid @enderror"
                   name="username" value="{{ old('username') }}" required
                   autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password">{{ __('user.password') }}</label>
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('user.confirmPassword') }}</label>
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required
                   autocomplete="new-password">
        </div>

        <div class="form-group">
            <label for="profile_image">{{ __('user.photo') }}</label>
            <input id="profile_image" type="file"
                   class="form-control @error('profile_image') is-invalid @enderror"
                   name="profile_image"
                   value="{{ old('profile_image') }}"
                   required
                   autocomplete="profile_image">
        </div>

        <div class="form-group">
            <label for="is_admin">{{ __('user.isAdmin') }}</label>
            <select name="is_admin" id="is_admin" class="form-control">
                <option value="1">Admin</option>
                <option value="0">Moderator</option>
            </select>
        </div>

        <div class="form-group mb-0">
            <div class="col-md-12" style="text-align: right">
                <button type="submit" class="btn btn-primary">
                    {{ __('user.addUser') }}
                </button>
            </div>
        </div>

        @include('admin.errors')
    </form>
@endsection
