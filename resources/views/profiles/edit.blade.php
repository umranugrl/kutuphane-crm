@extends('layouts.admin')

@section('title')
    @lang('profile.profile')
@endsection

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-keyboard-backspace"></i>
                        </a>
                    </div>
                </div>

                <h4 class="card-title">@lang('profile.profile_information')</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form class="forms-sample" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">@lang('profile.name')</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('profile.email')</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" disabled
                            name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">@lang('profile.password')</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">@lang('profile.confirm_password')</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_image">@lang('profile.profile_image')</label>
                        <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image">
                        @error('profile_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($user->profile_image)
                        <div class="form-group">
                            <img src="{{ asset($user->profile_image) }}" alt="Profil Resmi" class="img-thumbnail" width="150">
                        </div>
                    @endif

                    <hr>
                    
                    <div class="form-group">
                        <label for="current_password">@lang('profile.current_password')</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password" name="current_password">
                        @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> @lang('profile.update')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
