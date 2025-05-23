@extends('layouts.admin')
@section('title')
    @lang('category.new_category_add')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('category.index') }}" class="btn btn-secondary"><i
                                class="mdi mdi-keyboard-backspace"></i></a>
                    </div>
                </div>
                <h4 class="card-title">@lang('category.new_category_add')</h4>
                <form class="forms-sample" method="POST" action="{{ route('category.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">@lang('category.category_name')</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                            id="category_name" name="category_name" placeholder="Kategori Adı"
                            value="{{ old('category_name') }}">

                        @error('category_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">@lang('category.description')</label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="Açıklama" value="{{ old('description') }}"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection