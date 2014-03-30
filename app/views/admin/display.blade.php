@extends('layout.admin')

@section('sidebar')
    @include('admin.sidebar', array('page'=>'display'))
@stop

@section('block')

    <h3>Tokens</h3>

    <div class="config">
        <a></a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th width="15%">User</th>
            <th width="49%">Token</th>
            <th width="3%">Active</th>
            <th width="15%">Created</th>
            <th width="15%">Used</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tokens as $token)
        <tr @if (!$token->active) class="grey" @endif id="tr_{{ $token->id }}">
            <td>{{ $token->id }}</td>
            <td>{{ $token->user->email }}</td>
            <td>
                <div id="token_a_{{ $token->id }}" class="hidden mono">
                    <a href="{{ URL::to('do/tokens', $token->id) }}">{{ $token->token }}</a>
                </div>
                <a href="#" class="unhide" id="a_{{ $token->id }}">Show</a>
            </td>
            <td>@if (!$token->active) No @else Yes @endif</td>
            <td>@if ($token->created_at->format('U') > 0) {{ $token->created_at->format('Y-m-d H:i:s') }} @endif</td>
            <td>{{ $token->last_used }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>



@stop