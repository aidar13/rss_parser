@extends('admin.layouts.index')

@section('title', __('default.pages.admin.title'))

@section('content')

<div class="container container-fluid">
    <div class="title-block">
        <div class="row row--multiline align-items-center">
            <div class="col-md-4">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('panel.roles.index', $lang) }}">Управление ролями</a></li>
                    <li><span>{{ $role->name }}</span></li>
                    <li><span>Редактировать</span></li>
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
        {!! Form::model($role, ['method' => 'PATCH','route' => ['panel.roles.update', [$lang, $role->id]]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="input-group">
                    <label class="input-group__title">Название:</label>
                    <input type="text" name="name" placeholder="Название" class="input-regular" value="{{ $role->name }}" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <br>
                <div class="input-group">
                    <label class="input-group__title">Возможности: </label>
                    @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
        {!! Form::close() !!}
        <br>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['panel.roles.destroy', [ 'lang' => \request()->segment(1), $role->id ]],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn--red']) !!}
                {!! Form::close() !!}
            @endcan
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')
    <!--Only this page's scripts-->
    <!---->
@endsection
