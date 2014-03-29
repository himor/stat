@extends('layout.layout')

@section('content')
<div class="space200"></div>
<div class="line"></div>

    <div class="block">
    @yield('block')
    </div>

@stop

@section('footer')
<div class="line"></div>
<div class="space"></div>
Copyright &copy; Mike Gordo <a href="mailto:himor.cre@gmail.com">himor.cre@gmail.com</a>
@stop
