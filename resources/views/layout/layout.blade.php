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

<body class="{{ $isForm ? 'tw-bg-n100' : 'tw-bg-n200' }} scroll selection:tw-bg-b500 selection:tw-text-n100">

    <div id="loader"
        class="tw-absolute tw-justify-center tw-items-center tw-flex tw-top-0 tw-left-0 tw-z-50 tw-bg-n100 tw-opacity-80 tw-backdrop-blur-2xl tw-w-svw tw-h-svh">
        <span class="loader"></span>
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
    </script>

</body>

</html>
