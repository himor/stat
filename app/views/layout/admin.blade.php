@extends('layout.layout')

@section('content')
<div class="space"></div>
<div class="line"></div>

    <div class="sidebar">
        @yield('sidebar')
    </div>

    <div class="block">

        @if (Session::has('error'))
        <div class="error">
            <p>{{ Session::get('error') }}</p>
        </div>
        @endif

        @if (Session::has('success'))
        <div class="success">
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif

        @yield('block')

    </div>

@stop

@section('footer')
<div class="line"></div>
<div class="space"></div>
Copyright &copy; Mike Gordo <a href="mailto:himor.cre@gmail.com">himor.cre@gmail.com</a>
&middot;
{{ link_to_route('logout', 'Logout', null) }}
@stop
