@extends('layouts.admin')
@section('title')
    @lang('author.new_author_add')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('author.index') }}" class="btn btn-secondary"><i
                                class="mdi mdi-keyboard-backspace"></i></a>
                    </div>
                </div>
                <h4 class="card-title">@lang('author.new_author_add')</h4>
                <form class="forms-sample" method="POST" action="{{ route('author.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">@lang('author.full_name')</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                            name="full_name" placeholder="Ad Soyad" value="{{ old('full_name') }}">
                        @error('full_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_date">@lang('author.birth_date')</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="death_date">@lang('author.death_date')</label>
                        <input type="date" class="form-control" id="death_date" name="death_date" value="{{ old('death_date') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection