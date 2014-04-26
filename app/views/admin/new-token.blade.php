@extends('layout.admin')

@section('sidebar')
@include('admin.sidebar', array('page'=>'display'))
@stop

@section('block')

    <h3>New user</h3>

    {{ Form::model($token, [
        'route' => ['do/new.token'],
        'autocomplete' => 'off'
    ]) }}

    @if ($errors->any())
    {{ implode('', $errors->all('<div class="error">:message</div>')) }}
    @endif

    <div class="item">
        {{ Form::label('user_id', 'User'); }}
        {{ Form::select('user_id', $users); }}
    </div>

    <div class="item">
        {{ Form::label('value', 'Token'); }}
        {{ Form::text('value', null, ['readonly' => true]); }}
    </div>

    <div class="item">
        {{ Form::label('active', 'Active'); }}
        {{ Form::checkbox('active', 1); }}
    </div>

    <div class="item">
        {{ Form::submit('Create'); }}
        {{ link_to_route('do/tokens', 'Cancel', null, ['class' => 'cancel']) }}
    </div>

    @if (Session::has('message'))
    <div class="alert">
        <p>{{ Session::get('message') }}</p>
    </div>
    @endif

    {{ Form::close() }}

@stop