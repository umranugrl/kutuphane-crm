@extends('layouts.admin')
@section('title', __('loan.loans'))

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
                                    <label class="col-sm-3 col-form-label">@lang('panel.status')</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="">Seçiniz</option>
                                            <option value="borrowed" @if (isset($searchStatus) && $searchStatus == 'borrowed') selected @endif>
                                                @lang('loan.borrowed')</option>
                                            <option value="returned" @if (isset($searchStatus) && $searchStatus == 'returned') selected @endif>
                                                @lang('loan.returned')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                            

                            <div class="col-md-12 text-right">
                                <a href="{{ route('loan.index') }}" class="btn btn-default mb-2">@lang('panel.clear')</a>
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
                        <a href="{{ route('loan.create') }}" class="btn btn-success">
                            <em class="mdi mdi-plus-box"> @lang('loan.new_loan_add')</em>
                        </a>
                    </div>
                </div>
                <h4 class="card-title">@lang('loan.loans')</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('book.book_title')</th>
                                <th>@lang('book.author')</th>
                                <th>@lang('loan.loan_date')</th>
                                <th>@lang('loan.due_date')</th>
                                <th>@lang('loan.return_date')</th>
                                <th>@lang('reader.reader_name')</th>
                                <th>@lang('loan.admin')</th>
                                <th>@lang('loan.status')</th>
                                
                                <th>@lang('panel.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->book->title }}</td>
                                    <td>{{ $loan->book->author->full_name ?? 'Bilinmeyen Yazar' }}</td>
                                    <td>{{ $loan->loan_date }}</td>
                                    <td>{{$loan->due_date}} ({{ $loan->days_until_due }} gün)</td>
                                    <td>{{ $loan->return_date ?? 'Henüz iade edilmedi' }}</td>
                                    <td>{{ $loan->reader->reader_full_name ?? 'Bilinmiyor' }}</td>
                                    <td>{{ $loan->admin->name ?? 'Bilinmiyor' }}</td>
                                    
                                    <td>
                                        @if ($loan->status == 'borrowed')
                                            <span class="badge badge-warning">@lang('loan.borrowed')</span>
                                        @else
                                            <span class="badge badge-success">@lang('loan.returned')</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if ($loan->status == 'borrowed')
                                            <form action="{{ route('loan.return', $loan->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">@lang('loan.return_it')</button>
                                            </form>
                                        @else
                                            <span class="badge badge-secondary">@lang('loan.returned')</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $loans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
