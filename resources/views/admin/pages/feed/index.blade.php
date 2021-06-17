@extends('admin.layouts.index')

@section('title', __('default.pages.admin.title'))

@section('content')

<div class="container container-fluid">
    <div class="title-block">
        <div class="row row--multiline align-items-center">
            <div class="col-md-4">
                <h1 class="title-primary" style="margin-bottom: 0">Управление новостями</h1>
            </div>
            <div class="col-md-8 text-right-md text-right-lg">
                <div class="flex-form">
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <br>
    <div class="block">
        <h2 class="title-secondary">Список новостей</h2>
        <table class="table table-records">
            <colgroup>
                <col span="1" style="width: 3%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 40%;">
                <col span="1" style="width: 12%;">
                <col span="1" style="width: 12%;">
                <col span="1" style="width: 12%;">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>title</th>
                    <th>link</th>
                    <th>short_description</th>
                    <th>published_date</th>
                    <th>author</th>
                    <th>image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->link }}</td>
                        <td>{{ $item->short_description }}</td>
                        <td>{{ $item->published_date }}</td>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->image }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{--        {{ $items->appends(\Illuminate\Support\Facades\Request::except('page'))->links("vendor.pagination.admin") }}--}}
    </div>
</div>

@endsection
@section('scripts')
    <!--Only this page's scripts-->
    <!---->
@endsection
