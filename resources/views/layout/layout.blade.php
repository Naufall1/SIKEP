<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="{{ ($isForm) ? 'tw-bg-n100' : 'tw-bg-n200' }} scroll selection:tw-bg-b500 selection:tw-text-n100">

    @include('layout.nav')

    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        @yield('content')
    </div>

</body>

</html>