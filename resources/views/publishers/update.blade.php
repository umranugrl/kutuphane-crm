@extends('layouts.admin')
@section('title')
    @lang('publisher.publisher_edit')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('publisher.index') }}" class="btn btn-secondary"><i
                                class="mdi mdi-keyboard-backspace"></i></a>
                    </div>
                </div>
                <h4 class="card-title">@lang('publisher.publisher_edit')</h4>
                <form class="forms-sample" method="POST" action="{{ route('publisher.update', $publisher->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="publisher_name">@lang('publisher.publisher_name')</label>
                        <input type="text" class="form-control @error('publisher_name') is-invalid @enderror"
                            id="publisher_name" name="publisher_name" value="{{ $publisher->publisher_name }}">
                        @error('publisher_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">@lang('publisher.address')</label>
                        <textarea class="form-control" id="address" name="address">{{ old('address', $publisher->address) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="phons">@lang('publisher.phone')</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $publisher->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="website">@lang('publisher.website')</label>
                        <input type="text" class="form-control" id="website" name="website"
                            value="{{ $publisher->website }}">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">@lang('panel.save')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
