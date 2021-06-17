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

    <div class="block">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="input-group">
                    <strong>Название:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="input-group">
                    <strong>Возможности:</strong>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $permission)
                            <br>
                            <label class="label label-success">{{ $permission->name }}</label>
                        @endforeach
                    @endif
                </div>
            </div>

            <div>
                @can('role-edit')
                    <a class="btn btn-primary" href="{{ route('panel.roles.edit', [ 'lang' => \request()->segment(1), $role->id]) }}">Редактировать</a>
                @endcan
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
