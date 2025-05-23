@extends('layouts.admin')
@section('title')
    @lang('book.new_book_add')
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
                        <a href="{{ route('book.index') }}" class="btn btn-secondary"><i
                                class="mdi mdi-keyboard-backspace"></i></a>
                    </div>
                </div>
                <h4 class="card-title">@lang('book.new_book_add')</h4>
                <form class="forms-sample" method="POST" action="{{ route('book.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">@lang('book.book_title')</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" placeholder="Kitap Adı" value="{{ old('title') }}">

                        @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="author_id">@lang('book.select_author')</label>
                        <div class="d-flex">
                            <select class="form-control js-example @error('author_id') is-invalid @enderror" id="author_id"
                                name="author_id">
                                <option value="">@lang('panel.choose')</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}"
                                        {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-warning ml-2" data-toggle="modal"
                                data-target="#authorModal">
                                @lang('author.add_author')
                            </button>
                        </div>
                        @error('author_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                        @include('modals.author')
                    </div>

                    <div class="form-group">
                        <label for="year">@lang('book.year')</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year"
                            name="year" placeholder="Yılı" value="{{ old('year') }}">

                        @error('year')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="publisher_id">@lang('book.select_publisher')</label>
                        <div class="d-flex">
                            <select class="form-control js-example @error('publisher_id') is-invalid @enderror"
                                id="publisher_id" name="publisher_id">
                                <option value="">@lang('panel.choose')</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}"
                                        {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->publisher_name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-warning ml-2" data-toggle="modal"
                                data-target="#publisherModal"> @lang('publisher.add_publisher')</button>

                            @error('publisher_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            @include('modals.publisher')
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="isbn">@lang('book.isbn')</label>
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn"
                            name="isbn" placeholder="ISBN" value="{{ old('isbn') }}">

                        @error('isbn')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">@lang('book.select_category')</label>
                        <div class="d-flex">
                            <select class="form-control js-example  @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id">
                                <option value="">@lang('panel.choose')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="button" class="btn btn-warning ml-2" data-toggle="modal"
                                data-target="#categoryModal">@lang('category.add_category')</button>
                        </div>
                        @error('category_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                        @include('modals.category')
                    </div>

                    <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#categoryAdd').click(function() {
            $.ajax({
                url: "{{ route('book.categoryCreate') }}",
                method: "POST",
                data: {
                    category_name: $("input[name=category_name]").val(),
                    description: $("input[name=description]").val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        let newOption =
                            `<option value="${response.category.id}" selected>${response.category.category_name}</option>`;
                        $('#category_id').append(newOption);

                        $('#categoryModal').modal('hide');

                        $("input[name=category_name]").val('');
                        $("input[name=description]").val('');
                        $(".error-category_name").hide().text('');
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.category_name) {
                        $(".error-category_name").show().text(errors.category_name[0]);
                    }
                }
            });
        });

        $('#publisherAdd').click(function() {
            $.ajax({
                url: "{{ route('book.publisherCreate') }}",
                method: "POST",
                data: {
                    publisher_name: $("input[name=publisher_name]").val(),
                    address: $("input[name=address]").val(),
                    phone: $("input[name=phone]").val(),
                    website: $("input[name=website]").val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        let newOption =
                            `<option value="${response.publisher.id}" selected>${response.publisher.publisher_name}</option>`;
                        $('#publisher_id').append(newOption);

                        $('#publisherModal').modal('hide');

                        $("input[name=publisher_name]").val('');
                        $("input[name=address]").val('');
                        $("input[name=phone]").val('');
                        $("input[name=website]").val('');
                        $(".error-publisher_name").hide().text('');
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.publisher_name) {
                        $(".error-publisher_name").show().text(errors.publisher_name[0]);
                    }
                }
            });
        });

        $('#authorAdd').click(function() {
            $.ajax({
                url: "{{ route('book.authorCreate') }}",
                method: "POST",
                data: {
                    full_name: $("#full_name").val(),
                    birth_date: $("#birth_date").val(),
                    death_date: $("#death_date").val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        let newOption =
                            `<option value="${response.author.id}" selected>${response.author.full_name}</option>`;
                        $('#author_id').append(newOption);

                        $('#authorModal').modal('hide');

                        $("#full_name").val('');
                        $("#birth_date").val('');
                        $("#death_date").val('');
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.full_name) {
                        $(".error-full_name").show().text(errors.full_name[0]);
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.js-example').select2({
                width: '100%'
            });
        });
    </script>
@endsection
