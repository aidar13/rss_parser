@extends('admin.layouts.index')

@section('title', "Feeds")

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
        <div class="title-block">
            <div class="row row--multiline align-items-center">
                <div class="col-md-4">
                    <h2 class="title-secondary">Список новостей</h2>
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
                <col span="1" style="width: 25%;">
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Название</th>
                    <th>Краткое описание</th>
                    <th>Дата публикации</th>
                    <th>Автор</th>
                    <th>Ссылка</th>
{{--                    <th>Изображение</th>--}}
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ $item->link }}">{{ $item->title }}</a>/</td>
                        <td>{{ $item->short_description }}</td>
                        <td>{{ $item->published_date }}</td>
                        <td>{{ $item->author }}</td>
                        <td><a href="{{ $item->link }}">{{ $item->link }}</a></td>
{{--                        <td>{{ $item->image }}</td>--}}
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
