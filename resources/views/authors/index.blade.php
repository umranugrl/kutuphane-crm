@extends('layouts.admin')
@section('title')
    @lang('author.authors')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        <a href="{{ route('author.create') }}" class="btn btn-success">
                            <em class="mdi mdi-plus-box">@lang('author.new_author_add')</em>
                        </a>
                    </div>
                </div>
                <h4 class="card-title">@lang('author.authors')</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('author.full_name')</th>
                                <th>@lang('author.birth_date')</th>
                                <th>@lang('author.death_date')</th>
                                <th>@lang('panel.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                                <tr>
                                    <td>{{ $author->full_name }}</td>
                                    <td>{{ $author->birth_date }}</td>
                                    <td>{{ $author->death_date }}</td>
                                    <td>
                                        <a href="{{ route('author.edit', $author->id) }}" class="btn btn-primary">
                                            <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <a href="{{ route('author.delete', $author->id) }}"
                                            onclick="return confirm('Silmek istiyor musunuz?');" class="btn btn-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
