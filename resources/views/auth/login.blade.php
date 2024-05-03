@extends('layout.layout', ['isForm' => true])
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    @vite('resources/css/app.css', 'resources/js/app.js') --}}
    {{-- <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-container h2 {
        text-align: center;
    }
    .login-container form {
        display: flex;
        flex-direction: column;
    }
    .login-container form input {
        margin: 10px 0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .login-container form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
</style> --}}
@section('content')

    <div class="tw-pt-20 tw-px-5 tw-flex tw-h-[100vh] tw-w-full tw-items-center tw-justify-center">

        <div class="tw-flex tw-flex-col tw-w-full sm:tw-w-1/2 sm:tw-max-w-[702px] tw-gap-7">
            <div class="tw-flex tw-flex-col tw-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150"
                    fill="none">
                    <g clip-path="url(#clip0_2195_25379)">
                        <path
                            d="M75 150C116.421 150 150 116.421 150 75C150 33.5786 116.421 0 75 0C33.5786 0 0 33.5786 0 75C0 116.421 33.5786 150 75 150Z"
                            fill="#E6F2FF" />
                        <path
                            d="M75 150C116.421 150 150 116.421 150 75C150 33.5786 116.421 0 75 0C33.5786 0 0 33.5786 0 75C0 116.421 33.5786 150 75 150Z"
                            fill="#EEEEEE" />
                        <path
                            d="M32 43.5H118C120.485 43.5 122.5 45.5147 122.5 48V153C122.5 155.485 120.485 157.5 118 157.5H32C29.5147 157.5 27.5 155.485 27.5 153V48C27.5 45.5147 29.5147 43.5 32 43.5Z"
                            fill="white" stroke="#E3E3E3" />
                        <path
                            d="M66 53H40C38.3431 53 37 54.3431 37 56C37 57.6569 38.3431 59 40 59H66C67.6569 59 69 57.6569 69 56C69 54.3431 67.6569 53 66 53Z"
                            fill="#E6F2FF" />
                        <path
                            d="M66 95H40C38.3431 95 37 96.3431 37 98C37 99.6569 38.3431 101 40 101H66C67.6569 101 69 99.6569 69 98C69 96.3431 67.6569 95 66 95Z"
                            fill="#E6F2FF" />
                        <path
                            d="M108 68H42C39.7909 68 38 69.7909 38 72V82C38 84.2091 39.7909 86 42 86H108C110.209 86 112 84.2091 112 82V72C112 69.7909 110.209 68 108 68Z"
                            stroke="#027AFF" stroke-width="2" />
                        <path
                            d="M108 109H42C39.2386 109 37 111.239 37 114V122C37 124.761 39.2386 127 42 127H108C110.761 127 113 124.761 113 122V114C113 111.239 110.761 109 108 109Z"
                            fill="#CCE4FF" />
                        <path
                            d="M53 32C55.2091 32 57 30.2091 57 28C57 25.7909 55.2091 24 53 24C50.7909 24 49 25.7909 49 28C49 30.2091 50.7909 32 53 32Z"
                            fill="white" />
                        <path
                            d="M75 32C77.2091 32 79 30.2091 79 28C79 25.7909 77.2091 24 75 24C72.7909 24 71 25.7909 71 28C71 30.2091 72.7909 32 75 32Z"
                            fill="#027AFF" />
                        <path
                            d="M97 32C99.2091 32 101 30.2091 101 28C101 25.7909 99.2091 24 97 24C94.7909 24 93 25.7909 93 28C93 30.2091 94.7909 32 97 32Z"
                            fill="white" />
                        <path
                            d="M86 88C88.7614 88 91 85.7614 91 83C91 80.2386 88.7614 78 86 78C83.2386 78 81 80.2386 81 83C81 85.7614 83.2386 88 86 88Z"
                            fill="#CCE4FF" />
                        <path
                            d="M89.9071 104.37C89.1071 104.37 88.3601 104.37 87.6801 104.327C86.8425 104.27 86.0367 103.984 85.3515 103.499C84.6662 103.014 84.128 102.349 83.7961 101.578L79.5771 93.24C79.2676 92.8797 79.1131 92.4117 79.1472 91.938C79.1813 91.4643 79.4012 91.0233 79.7591 90.711C80.0522 90.4754 80.418 90.3485 80.7941 90.352C81.071 90.3601 81.3428 90.4281 81.5909 90.5513C81.839 90.6746 82.0574 90.8502 82.2311 91.066L84.1471 93.681L84.1761 93.715V83.78C84.1761 83.2871 84.3719 82.8144 84.7204 82.4659C85.069 82.1173 85.5417 81.9215 86.0346 81.9215C86.5275 81.9215 87.0002 82.1173 87.3487 82.4659C87.6973 82.8144 87.8931 83.2871 87.8931 83.78V90.28C87.8715 90.0408 87.9 89.7998 87.9767 89.5722C88.0534 89.3446 88.1767 89.1355 88.3387 88.9582C88.5007 88.781 88.6979 88.6394 88.9176 88.5425C89.1374 88.4456 89.3749 88.3956 89.6151 88.3956C89.8552 88.3956 90.0928 88.4456 90.3125 88.5425C90.5323 88.6394 90.7294 88.781 90.8914 88.9582C91.0534 89.1355 91.1767 89.3446 91.2535 89.5722C91.3302 89.7998 91.3587 90.0408 91.3371 90.28V91.635C91.3155 91.3958 91.344 91.1548 91.4207 90.9272C91.4974 90.6996 91.6207 90.4905 91.7827 90.3132C91.9447 90.136 92.1419 89.9944 92.3616 89.8975C92.5814 89.8006 92.8189 89.7506 93.0591 89.7506C93.2992 89.7506 93.5368 89.8006 93.7565 89.8975C93.9763 89.9944 94.1734 90.136 94.3354 90.3132C94.4974 90.4905 94.6207 90.6996 94.6975 90.9272C94.7742 91.1548 94.8027 91.3958 94.7811 91.635V92.679C94.7595 92.4398 94.788 92.1988 94.8647 91.9712C94.9414 91.7436 95.0647 91.5345 95.2267 91.3572C95.3887 91.18 95.5859 91.0384 95.8056 90.9415C96.0254 90.8446 96.2629 90.7946 96.5031 90.7946C96.7432 90.7946 96.9808 90.8446 97.2005 90.9415C97.4203 91.0384 97.6174 91.18 97.7794 91.3572C97.9414 91.5345 98.0647 91.7436 98.1415 91.9712C98.2182 92.1988 98.2467 92.4398 98.2251 92.679V99.016C98.1911 100.965 97.3101 104.251 94.2111 104.251C93.9861 104.261 92.0801 104.371 89.9111 104.371L89.9071 104.37Z"
                            fill="#027AFF" stroke="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_2195_25379">
                            <rect width="150" height="150" rx="75" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <div class="tw-flex tw-flex-col tw-gap-1 tw-justify-center">
                    <h1 class="tw-h1 tw-text-n1000 tw-text-center">Selamat Datang!</h1>
                    <p class="tw-caption tw-text-n1000 tw-text-center">Masukkan nama pengguna dan kata sandi untuk masuk</p>
                </div>
            </div>
            <form class="tw-flex tw-flex-col tw-items-end tw-gap-8" action="{{ route('login') }}" method="post">
                {{ csrf_field() }}

                <x-input.label class="tw-w-full" for="username" label="Nama Pengguna">
                    <x-input.input placeholder="Masukkan Nama Pengguna"
                        type="text" id="username" name="username"></x-input.input>
                </x-input.label>

                <x-input.label class="tw-w-full" for="password" label="Kata Sandi">
                    <x-input.password placeholder="Masukkan Kata Sansi"
                        id="password" name="password"></x-input.password>
                </x-input.label>

                <div class="tw-flex tw-w-full tw-justify-between md:tw-gap-3 md:tw-items-end">
                    <button
                        class="tw-btn tw-btn-lg-ilead tw-btn-outline tw-btn-round"
                        type="button">
                        <x-icons.actionable.arrow-left class="tw-bg-cover" stroke="1.5" color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </button>
                    <button
                        class="tw-btn tw-btn-lg tw-btn-round tw-btn-primary"
                        type="submit">Masuk</button>
                </div>
            </form>
        </div>

    </div>

@endsection



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Ganti gambar mata tergantung pada tipe input
            if (type === 'password') {
                eyeIcon.src = "{{ asset('assets/icons/actionable/eye.svg') }}";
            } else {
                eyeIcon.src = "{{ asset('assets/icons/actionable/eye-slash.svg') }}";
            }
        });
    });
</script>
