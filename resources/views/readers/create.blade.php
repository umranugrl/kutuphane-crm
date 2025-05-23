@extends('layouts.admin')
@section('title')
    @lang('reader.new_reader_add')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('reader.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-keyboard-backspace"></i>
                        </a>
                    </div>
                </div>
                <h4 class="card-title">@lang('reader.new_reader_add')</h4>
                <form class="forms-sample" method="POST" action="{{ route('reader.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="reader_full_name">@lang('reader.reader_full_name')</label>
                        <input type="text" class="form-control @error('reader_full_name') is-invalid @enderror"
                            id="reader_full_name" name="reader_full_name" placeholder="Ad Soyad"
                            value="{{ old('reader_full_name') }}">
                        @error('reader_full_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">@lang('reader.email')</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="E-Posta" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">@lang('reader.phone')</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" placeholder="Telefon" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">@lang('reader.address')</label>
                        <textarea class="form-control" name="address" placeholder="Adres">{{ old('address') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="mdi mdi-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection