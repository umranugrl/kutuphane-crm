@extends('layouts.admin')
@section('title')
    @lang('reader.readers')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('reader.create') }}" class="btn btn-success">
                            <em class="mdi mdi-plus-box">@lang('reader.new_reader_add')</em>
                        </a>
                    </div>
                </div>
                <h4 class="card-title">@lang('reader.readers')</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('reader.reader_full_name')</th>
                                <th>@lang('reader.email')</th>
                                <th>@lang('reader.phone')</th>
                                <th>@lang('reader.address')</th>
                                <th>@lang('panel.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($readers as $reader)
                                <tr>
                                    <td>{{ $reader->reader_full_name }}</td>
                                    <td>{{ $reader->email }}</td>
                                    <td>{{ $reader->phone }}</td>
                                    <td>{{ $reader->address }}</td>
                                    <td>
                                        <a href="{{ route('reader.edit', $reader->id) }}" class="btn btn-primary"><em
                                                class="mdi mdi-lead-pencil"></em></a>
                                        <a href="{{ route('reader.delete', $reader->id) }}"
                                            onclick="return confirm('Silmek istiyor musunuz?');" class="btn btn-danger"><em
                                                class="mdi mdi-delete"></em></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $readers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
