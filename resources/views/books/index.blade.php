@extends('layouts.admin')
@section('title')
    @lang('book.books')
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title">@lang('panel.filter')</h4>
                        <form id="search_form" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">@lang('book.book_title')</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control"
                                                @isset($searchTitle) value="{{ $searchTitle }}" @endisset />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">@lang('book.author_full_name')</label>
                                        <div class="col-sm-9">
                                            <select name="author_id" class="form-control js-example">
                                                <option value="">Seçiniz</option>
                                                @foreach ($authors as $author)
                                                    <option value="{{ $author->id }}"
                                                        @if (isset($searchAuthorId) && $searchAuthorId == $author->id) selected @endif>
                                                        {{ $author->full_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">@lang('book.isbn')</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="isbn" class="form-control"
                                                @isset($searchIsbn) value="{{ $searchIsbn }}" @endisset />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">@lang('category.category_name')</label>
                                        <div class="col-sm-9">
                                            <select name="category_id" class="form-control js-example">
                                                <option value="">Seçiniz</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if (isset($searchCategoryId) && $searchCategoryId == $category->id) selected @endif>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">@lang('panel.status')</label>
                                        <div class="col-sm-9">
                                            <select name="status" class="form-control">
                                                <option value="">Seçiniz</option>
                                                <option value="available" @if (isset($searchStatus) && $searchStatus == 'available') selected @endif>
                                                    @lang('loan.available')
                                                </option>
                                                <option value="borrowed" @if (isset($searchStatus) && $searchStatus == 'borrowed') selected @endif>
                                                    @lang('loan.borrowed')
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-right">
                                    <a href="{{ route('book.index') }}" class="btn btn-default mb-2">@lang('panel.clear')</a>
                                    <button type="submit" class="btn btn-primary mb-2">@lang('panel.filter')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('book.create') }}" class="btn btn-success">
                            <i class="mdi mdi-plus-box"></i>
                        </a>
                        <a href="{{ route('book.deleted') }}" title={{ __('panel.deleted') }} class="btn btn-warning">
                            <i class="mdi mdi-delete"></i>
                        </a>
                        <button type="button" class="btn btn-info btn-excel" data-toggle="modal"
                            data-target="#book-excel-import" title={{ __('panel.excel_import') }}><i
                                class="mdi mdi-file-import"></i></button>
                        <a href="{{ route('book.excel_export') }}" title={{ __('panel.excel_export') }}
                            class="btn btn-primary"><i class="mdi mdi-file-export"></i>
                        </a>
                    </div>
                </div>


                <h4 class="card-title">@lang('book.books')</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('book.book_title')</th>
                                <th>@lang('book.author')</th>
                                <th>@lang('book.year')</th>
                                <th>@lang('publisher.publisher_name')</th>
                                <th>@lang('book.isbn')</th>
                                <th>@lang('category.category_name')</th>
                                <th>@lang('panel.status')</th>
                                <th>@lang('panel.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author->full_name ?? 'Bilinmeyen Yazar' }}</td>
                                    <td>{{ $book->year }}</td>
                                    <td>{{ $book->publisher->publisher_name ?? 'Bilinmeyen Yayın Evi' }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ $book->category->category_name ?? 'Kategori Yok' }}</td>

                                    <!-- Ödünç Durumu -->
                                    <td>
                                        @if ($book->loans()->where('status', 'borrowed')->exists())
                                            <span class="badge badge-warning">@lang('loan.borrowed')</span>
                                        @else
                                            <span class="badge badge-success">@lang('loan.available')</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary">
                                            <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <a href="{{ route('book.delete', $book->id) }}"
                                            onclick="return confirm('Silmek istiyor musunuz?');" class="btn btn-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $books->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="book-excel-import">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('panel.excel_import') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="{{ asset('ornek_sablon.xlsx') }}" download>@lang('panel.download_draft')</a>
                    <form method="POST" action="{{ route('book.excel_upload') }}" id="book-import-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3">
                                <label class="mainlabel" style="margin:16px;">{{ __('panel.warm') }}</label>
                            </div>

                            <div class="col-md-3">
                                <input type="file" name="excel_file" class="form-control" />
                            </div>
                            <div err-name="excel_file"></div>
                        </div>
                        <div success-text></div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mb-2">{{ __('panel.save') }}</button>
                        </div>
                    </form>
                </div>
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
