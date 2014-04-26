@extends('layout.admin')

@section('sidebar')
    @include('admin.sidebar', array('page'=>'users'))
@stop

@section('block')

    <h3>Users</h3>

    <div class="config">
        <a href="{{ URL::route('do/new.user') }}">Create new</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th width="32%">Email</th>
            <th width="32%">Name</th>
            <th width="3%">Active</th>
            <th width="15%">Created</th>
            <th width="15%">No. tokens</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
        <tr @if ($user->blocked) class="grey" @endif id="tr_{{ $user->id }}">
        <td><a href="{{ URL::route('do/user', $user->id) }}">{{ $user->id }}</a></td>
        <td><a href="{{ URL::route('do/user', $user->id) }}">{{ $user->email }}</a></td>
        <td>{{ $user->name }}</td>
        <td>@if ($user->blocked) No @else Yes @endif</td>
        <td>@if ($user->created_at->format('U') > 0) {{ $user->created_at->format('Y-m-d H:i:s') }} @endif</td>
        <td>{{ count($user->tokens) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

@stop