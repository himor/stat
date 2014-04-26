@extends('layout.admin')

@section('sidebar')
@include('admin.sidebar', array('page'=>'users'))
@stop

@section('block')

    <h3>Edit user</h3>

    {{ Form::model($user, array('route' => array('do/user', $user->id), 'autocomplete' => 'off')) }}

    @if ($errors->any())
    {{ implode('', $errors->all('<div class="error">:message</div>')) }}
    @endif

    {{ Form::hidden('id'); }}

    <div class="item">
        {{ Form::label('name', 'Name'); }}
        {{ Form::text('name'); }}
    </div>

    <div class="item">
        {{ Form::label('email', 'E-Mail Address'); }}
        {{ Form::text('email'); }}
    </div>

    <div class="item">
        {{ Form::label('password', 'New Password'); }}
        {{ Form::password('password'); }}
    </div>

    <div class="item">
        {{ Form::label('blocked', 'Blocked'); }}
        {{ Form::checkbox('blocked', 1); }}
    </div>

    <div class="item">
        {{ Form::submit('Update'); }}
        {{ link_to_route('do/users', 'Cancel',null, array('class' => 'cancel')) }}
    </div>

    @if (Session::has('message'))
    <div class="alert">
        <p>{{ Session::get('message') }}</p>
    </div>
    @endif

    {{ Form::close() }}

@stop