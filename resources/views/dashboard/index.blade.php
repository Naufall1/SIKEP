@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-20">
        <h1>Selamat datang {{ $text }}</h1>
        <a href="{{ route('login') }}">Login</a><br>
    </div>
@endsection
