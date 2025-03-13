@extends('layouts.auth')

@section('title', 'Kayıt Ol')

@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.jpg" alt="logo">
              </div>
              <h4>@lang('auth.are_you_new_here')</h4>
              <h6 class="font-weight-light">@lang('auth.signing_up_only_takes_a_few_steps')</h6>
               <form class="pt-3" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Ad Soyad" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-lg" name="email" placeholder="E-posta" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" name="password" placeholder="Şifre" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Şifre Tekrar" required>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">@lang('auth.register')
                </button>
            </div>
            <div class="text-center mt-4 font-weight-light">
                @lang('auth.already_have_an_account') <a href="{{ route('login') }}" class="text-primary">@lang('auth.login')</a>
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
