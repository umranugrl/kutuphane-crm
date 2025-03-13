@extends('layouts.admin')
@section('title', __('loan.new_loan_add'))
@section('css')
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            /* Bootstrap form-control çerçevesi */
            height: calc(2.5rem + 8px);
            /* Bootstrap form-control yüksekliği */
            padding: 0.75rem 0.75rem;
            /* Bootstrap iç boşluğu */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('loan.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left-bold-circle"></i>
                        </a>
                    </div>
                </div>
                <h4 class="card-title">@lang('loan.new_loan_add')</h4>
                <form class="forms-sample" method="POST" action="{{ route('loan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="book_id">@lang('book.book_title')</label>
                        <select class="form-control js-example @error('book_id') is-invalid @enderror" id="book_id" name="book_id">
                            <option value="">@lang('panel.choose')</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reader_id">@lang('reader.reader_name')</label>
                        <select class="form-control js-example @error('reader_id') is-invalid @enderror" id="reader_id"
                            name="reader_id">
                            <option value="">@lang('panel.choose')</option>
                            @foreach ($readers as $reader)
                                <option value="{{ $reader->id }}" {{ old('reader_id') == $reader->id ? 'selected' : '' }}>
                                    {{ $reader->reader_full_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('reader_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="loan_date">@lang('loan.loan_date')</label>
                        <input type="date" class="form-control @error('loan_date') is-invalid @enderror" id="loan_date"
                            name="loan_date" value="{{ old('loan_date') }}">
                        @error('loan_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example').select2({
                width: '100%'
            });
        });
    </script>
@endsection
