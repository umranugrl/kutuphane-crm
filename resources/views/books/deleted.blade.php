@extends('layouts.admin')
@section('title')
    @lang('book.books')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('book.index') }}" class="btn btn-primary">
                            <em class="mdi mdi-keyboard-return"></em>
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
                                        @if ($book->deleted_at)
                                            <span class="badge badge-danger">@lang('book.deleted')</span>
                                        @else
                                            @if ($book->loans()->where('status', 'borrowed')->exists())
                                                <span class="badge badge-warning">@lang('loan.borrowed')</span>
                                            @else
                                                <span class="badge badge-success">@lang('loan.available')</span>
                                            @endif
                                        @endif

                                    </td>

                                    <td>
                                        <a href="{{ route('book.restore', $book->id) }}" class="btn btn-warning">
                                            <em class="mdi mdi-restore"></em></a>
                                        <a href="{{ route('book.forceDelete', $book->id) }}"
                                            onclick="return confirm('Bu kitabı kalıcı olarak silmek istediğinize emin misiniz?');"
                                            class="btn btn-danger">
                                            <em class="mdi mdi-delete-forever"></em>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
