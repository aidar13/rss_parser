@extends('admin.layouts.index')

@section('title', __('default.pages.admin.title'))

@section('content')

<div class="container container-fluid">
    <div class="title-block">
        <div class="row row--multiline align-items-center">
            <div class="col-md-4">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('panel.roles.index', $lang) }}">Управление ролями</a></li>
                    <li><span>Создать новый роль</span></li>
                </ul>
            </div>
            <div class="col-md-8 text-right-md text-right-lg">
                <div class="flex-form">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('panel.roles.index', [ 'lang' => \request()->segment(1) ]) }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="block">
        <form class="block" method="post" action="{{route('panel.roles.store', $lang) }}">
            @csrf
            <h2 class="title-primary">Роль</h2>
            <div class="input-group">
                <label class="input-group__title">Название <span class="required">*</span></label>
                <input type="text" name="name" placeholder="Название" class="input-regular" required>
            </div>
            <br>
            <div class="input-group">
                <label class="input-group__title">Возможности: </label>
                @foreach($permission as $value)
                    <label class="checkbox">
                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        <span>{{ $value->name }}</span>
                    </label>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
    <!--Only this page's scripts-->
    <!---->
@endsection
