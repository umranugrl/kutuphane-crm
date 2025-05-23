@extends('layouts.admin')
@section('title')
    @lang('publisher.publishers')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('publisher.create') }}" class="btn btn-success">
                            <em class="mdi mdi-plus-box">@lang('publisher.new_publisher_add')</em>
                        </a>
                    </div>
                </div>
                <h4 class="card-title">@lang('publisher.publishers')</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('publisher.publisher_name')</th>
                                <th>@lang('publisher.address')</th>
                                <th>@lang('publisher.phone')</th>
                                <th>@lang('publisher.website')</th>
                                <th>@lang('panel.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publishers as $publisher)
                                <tr>
                                    <td>{{ $publisher->publisher_name }}</td>
                                    <td>{{ $publisher->address }}</td>
                                    <td>{{ $publisher->phone }}</td>
                                    <td>{{ $publisher->website }}</td>
                                    <td>
                                        <a href="{{ route('publisher.edit', $publisher->id) }}" class="btn btn-primary"><i
                                                class="mdi mdi-lead-pencil"></i></a>
                                        <a href="{{ route('publisher.delete', $publisher->id) }}"
                                            onclick="return confirm('Silmek istiyor musunuz?');" class="btn btn-danger"><i
                                                class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $publishers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
