@extends('layouts.auth')

@section('title', 'Giriş Yap')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ asset('images/logo.jpg') }}" alt="logo">
                            </div>
                            <h4>@lang('auth.welcome')</h4>
                            <h6 class="font-weight-light">@lang('auth.sign_in_to_continue')</h6>
                            <form class="pt-3" method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="E-posta">

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        placeholder="Şifre" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember" value="1"
                                                @checked(old('remember'))>
                                            @lang('auth.remember_me')
                                        </label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="auth-link text-black">@lang('auth.forgot_your_password')</a>
                                </div>

                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">@lang('auth.login')</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    @lang('auth.dont_have_an_account') <a href="{{ route('register') }}"
                                        class="text-primary">@lang('auth.register')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

@section('js')
@endsection
