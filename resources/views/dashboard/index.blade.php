@extends('layout.layout', ['isForm' => false])

@section('content')

        <h1>Selamat datang {{ $text }}</h1>
        <a href="{{ route('login') }}">Login</a><br>

@endsection
