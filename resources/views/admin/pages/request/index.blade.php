@extends('admin.layouts.index')

@section('title', "Feeds")

@section('content')

<div class="container container-fluid">
    <div class="title-block">
        <div class="row row--multiline align-items-center">
            <div class="col-md-4">
                <h1 class="title-primary" style="margin-bottom: 0">Управление запросами</h1>
            </div>
            <div class="col-md-8 text-right-md text-right-lg">
                <div class="flex-form">
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="title-block">
            <div class="row row--multiline align-items-center">
                <div class="col-md-4">
                    <h2 class="title-secondary">Список запросов</h2>
                </div>
                <div class="col-md-8 text-right-md text-right-lg">
                    <div class="flex-form">
                        <div>
                            <h2 class="title-secondary">Всего - {{ $items->total() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-records">
            <colgroup>
                <col span="1" style="width: 3%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 40%;">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Дата и время</th>
                    <th>Request Method</th>
                    <th>Request URL</th>
                    <th>Response HTTP Code</th>
                    <th>Response Body</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->method }}</td>
                        <td>{{ $item->url }}</td>
                        <td>{{ $item->response_code }}</td>
                        <td>{{ $item->response_body }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $items->appends(\Illuminate\Support\Facades\Request::except('page'))->links("vendor.pagination.admin") }}
    </div>
</div>

@endsection
@section('scripts')
    <!--Only this page's scripts-->
    <!---->
@endsection
