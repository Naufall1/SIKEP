<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="{{ ($isForm) ? 'tw-bg-n100' : 'tw-bg-n200' }} scroll selection:tw-bg-b500 selection:tw-text-n100">

    @include('layout.nav')

    @yield('content')

</body>

</html>