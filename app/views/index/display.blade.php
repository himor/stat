@extends('layout.index')

@section('block')

    <h3>API interface</h3>

    <pre>This URL is expecting a POST request</pre>

    <div class="config">
        <a href="{{ URL::route('do') }}">Login as admin</a>
    </div>

@stop