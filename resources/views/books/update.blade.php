@extends('layouts.admin')
@section('title')
    @lang('book.book_edit')
@endsection
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
                        <a href="{{ route('book.index') }}" class="btn btn-success"><i
                                class="mdi mdi-arrow-left-bold-circle"></i></a>
                    </div>
                </div>
                <h4 class="card-title">@lang('book.book_edit')</h4>
                <form class="forms-sample" method="POST" action="{{ route('book.update', $book->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">@lang('book.book_title')</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ $book->title }}">
                        @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="author_id">@lang('book.select_author')</label>
                        <select class="form-control js-example @error('author_id') is-invalid @enderror" id="author_id"
                            name="author_id" required>
                            <option value="">@lang('panel.choose')</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                    {{ $author->full_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="year">@lang('book.year')</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year"
                            name="year" value="{{ $book->year }}">
                        @error('year')
                            <div class="text-danger mt1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="publisher_id">@lang('book.select_publisher')</label>
                        <select class="form-control js-example @error('publisher_id') is-invalid @enderror"
                            id="publisher_id" name="publisher_id">
                            <option value="">@lang('panel.choose')</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}"
                                    {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->publisher_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="isbn">@lang('book.isbn')</label>
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn"
                            name="isbn" value="{{ $book->isbn }}">
                        @error('isbn')
                            <div class="text-danger mt1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">@lang('book.select_category')</label>
                        <select class="form-control js-example @error('category_id') is-invalid @enderror" id="category_id"
                            name="category_id" required>
                            <option value="">@lang('panel.choose')</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">@lang('panel.save')</button>
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
