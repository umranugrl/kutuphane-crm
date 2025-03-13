@extends('layouts.admin')
@section('title')
    @lang('category.categories')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('category.create') }}" class="btn btn-success">
                            <em class="mdi mdi-plus-box">@lang('category.new_category_add')</em>
                        </a>
                    </div>
                </div>
                <h4 class="card-title">@lang('category.categories')</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('category.category_name')</th>
                                <th>@lang('category.description')</th>
                                <th>@lang('panel.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td >
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary"><em
                                                class="mdi mdi-lead-pencil"></em></a>
                                        <a href="{{ route('category.delete', $category->id) }}"
                                            onclick="return confirm('Silmek istiyor musunuz?');" class="btn btn-danger"><em
                                                class="mdi mdi-delete"></em></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
