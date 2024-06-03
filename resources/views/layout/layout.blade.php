<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
    @yield('head')
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/icon" href="{{ asset('assets/logo/sikep.png') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite('resources/css/app.css', 'build/')
    @vite('resources/js/app.js', 'build/')
</head>

<body class="{{ $isForm ? 'tw-bg-n100' : 'tw-bg-n200' }} selection:tw-bg-b500 selection:tw-text-n100">

    <div id="loader"
        class="tw-absolute tw-justify-center tw-items-center tw-flex tw-top-0 tw-left-0 tw-z-50 tw-bg-n100 tw-opacity-80 tw-backdrop-blur-2xl tw-w-svw tw-h-svh">
        <span class="loader"></span>
    </div>

    <div id="floatingFlash"
        class="tw-fixed tw-flex tw-flex-col tw-gap-3 tw-z-50 tw-w-full-mobile-w md:tw-w-[420px] lg:tw-w-[500px] tw-h-fit tw-top-5 tw-left-1/2 -tw-translate-x-1/2">
        @if (session()->has('flash'))
            @php
                $message = session()->get('flash')->message;
            @endphp
            @switch(session()->get('flash')->type)
                @case('information')
                    <x-flash-message.information message='{{$message}}'></x-flash-message.information>
                    @break
                @case('error')
                    <x-flash-message.warning message='{{$message}}'></x-flash-message.warning>
                @break
                @case('success')
                    <x-flash-message.success message='{{$message}}'></x-flash-message.success>
                    @break
                @default
            @endswitch
        @endif
        {{-- <x-flash-message.information message='halo'></x-flash-message.information> --}}
    </div>

    @include('layout.nav')



    @yield('content')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('footer')

    @stack('js')

    <script>
        document.onreadystatechange = function() {
            console.log(document.readyState);
            if (document.readyState !== "complete") {
                document.querySelector("body").style.overflow = "hidden";
                document.querySelector("#loader").style.visibility = "visible";
            } else {
                document.querySelector("#loader").style.display = "none";
                document.querySelector("body").style.overflow = "auto";
            }
        };

        $(document).ready(function() {
            if ($('#floatingFlash').length) {
                setTimeout(function() {
                    $('#floatingFlash').remove();
                }, 5000);
            };
        });
    </script>

</body>

</html>
