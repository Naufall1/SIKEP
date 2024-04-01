<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
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
</head>

<body>

    {{-- @@section('navbar') --}}

    <div class="bg-n100 h-20 w-full mx-[100px] flex content-center items-center border-b-[1px] border-n400 fixed">
        <svg xmlns="http://www.w3.org/2000/svg" width="118" height="15" viewBox="0 0 118 15" fill="none">
            <path
                d="M106.881 5.14453C106.881 2.55176 108.92 0.811523 112.058 0.811523C115.134 0.811523 117.024 2.36719 117.024 4.66992C117.024 6.41016 115.565 7.72852 114.888 8.32617L111.909 10.9629V11.0332H117.173V13.8457H107.101V11.3672L112.199 6.8584C113.051 6.09375 113.438 5.4873 113.438 4.78418C113.438 4.09863 112.884 3.5625 111.926 3.5625C110.959 3.5625 110.274 4.21289 110.274 5.13574V5.21484H106.881V5.14453Z"
                fill="#027AFF" />
            <path
                d="M99.7183 14.1973C96.2905 14.1973 94.1284 11.666 94.1284 7.47363C94.1284 3.25488 96.3169 0.802734 99.7183 0.802734C103.12 0.802734 105.299 3.24609 105.299 7.46484C105.299 11.6484 103.146 14.1973 99.7183 14.1973ZM99.7183 11.332C100.755 11.332 101.502 10.084 101.502 7.47363C101.502 4.85449 100.755 3.66797 99.7183 3.66797C98.6812 3.66797 97.9253 4.85449 97.9253 7.47363C97.9253 10.084 98.6812 11.332 99.7183 11.332Z"
                fill="#027AFF" />
            <path
                d="M84.5312 6.58594L82.6416 13.8457H79.126L75.8564 1.16309H79.7061L81.165 9.17871H81.2354L83.125 1.16309H86.0078L87.8975 9.17871H87.9678L89.4268 1.16309H93.2764L90.0068 13.8457H86.4912L84.6016 6.58594H84.5312Z"
                fill="#027AFF" />
            <path
                d="M67.7446 3.91406V7.13086H69.2827C70.3286 7.13086 70.9702 6.48926 70.9702 5.53125C70.9702 4.59082 70.2935 3.91406 69.2915 3.91406H67.7446ZM67.7446 9.5918V13.8457H64.0181V1.16309H69.6519C73.0356 1.16309 74.7759 2.75391 74.7759 5.46973C74.7759 6.96387 74.0552 8.40527 72.728 9.03809L75.1362 13.8457H70.9702L68.9663 9.5918H67.7446Z"
                fill="#027AFF" />
            <path d="M61.5747 10.207H55.7827V7.14844H61.5747V10.207Z" fill="#027AFF" />
            <path
                d="M43.54 1.16309H49.332C52.1533 1.16309 54.0518 2.96484 54.0518 5.78613C54.0518 8.58105 52.0391 10.3828 49.0771 10.3828H47.2666V13.8457H43.54V1.16309ZM47.2666 3.9668V7.63184H48.3125C49.5518 7.63184 50.29 7.00781 50.29 5.79492C50.29 4.59082 49.5518 3.9668 48.3389 3.9668H47.2666Z"
                fill="#027AFF" />
            <path
                d="M41.4399 10.8838V13.8457H32.4927V1.16309H41.4399V4.125H36.2192V6.17285H41.1147V8.84473H36.2192V10.8838H41.4399Z"
                fill="#027AFF" />
            <path
                d="M23.1504 13.8457H19.4238V1.16309H23.1504V6.54199H23.2207L27.1406 1.16309H31.0518L26.877 6.79688L31.2451 13.8457H26.9121L24.1436 9.1875L23.1504 10.5234V13.8457Z"
                fill="#027AFF" />
            <path d="M17.3057 13.8457H13.5791V1.16309H17.3057V13.8457Z" fill="#027AFF" />
            <path
                d="M0.82666 10.1104H4.35107C4.45654 10.8311 5.33545 11.3057 6.3374 11.3057C7.45361 11.3057 8.13916 10.8574 8.13916 10.2422C8.13916 9.65332 7.67334 9.39844 6.31104 9.15234L4.63232 8.85352C2.30322 8.44922 1.0376 7.11328 1.0376 5.12695C1.0376 2.56055 3.23486 0.943359 6.2583 0.943359C9.6333 0.943359 11.5229 2.49023 11.5405 4.95117H8.13916C8.11279 4.16016 7.33057 3.69434 6.32861 3.69434C5.35303 3.69434 4.73779 4.09863 4.73779 4.73145C4.73779 5.33789 5.25635 5.6543 6.46045 5.86523L8.20068 6.16406C10.6616 6.59473 11.813 7.76367 11.813 9.82031C11.813 12.4131 9.64209 14.0654 6.26709 14.0654C2.86572 14.0654 0.835449 12.6416 0.82666 10.1104Z"
                fill="#027AFF" />
        </svg>
        {{-- <div class="">
            <button type="button" class="h-7">
                
            </button>
        </div> --}}
    </div>

    {{-- @endsection --}}

    <div class="pt-20 mx-auto flex h-[100vh] w-full items-center justify-center">

        <div class="flex flex-col w-1/2 max-w-[702px] gap-7">
            <div class="flex flex-col items-center">
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
                <div class="flex flex-col gap-1 justify-center">
                    <h1 class="h1 text-n1000 text-center">Selamat Datang!</h1>
                    <p class="caption text-n1000 text-center">Masukkan nama pengguna dan kata sandi untuk masuk</p>
                </div>
            </div>
            <form class="flex flex-col items-end gap-8" action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <label for="username" class="w-full flex flex-col">
                    <span class="label mb-2 ">Nama Pengguna</span>
                    <input class="input-enabled" type="text" id="username" name="username"
                        placeholder="Masukkan Nama Pengguna" required>
                </label>
                <label for="password" class="w-full flex flex-col">
                    <span class="label mb-2 ">Kata Sandi</span>
                    <div class="w-full flex flex-col relative group">
                        <input class="input-enabled" type="text" id="password" name="password"
                            placeholder="Masukkan Kata Sandi" required>
                        <span id="togglePassword"
                            class="absolute top-1/2 -translate-y-1/2 right-3 flex items-center pl-2 cursor-pointer">
                            <img id="eyeIcon" src="{{ asset('assets/icons/actionable/eye.svg') }}"
                                alt="eye">
                        </span>
                    </div>
                </label>

                <div class="flex gap-3 items-end">
                    <button
                        class="relative h-11 pl-12 pr-6 bg-n100 border-2 border-n1000 font-sans font-bold text-base rounded-full hover:bg-n200 active:bg-n300"
                        type="button">
                        <span class="absolute top-1/2 -translate-y-1/2 left-2 flex items-center pl-2 cursor-pointer">
                            <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                        </span>
                        Kembali
                    </button>
                    <button
                        class="h-11 px-6 bg-b500 text-n100 font-sans font-bold text-base rounded-full hover:bg-b600 active:bg-b700"
                        type="submit">Masuk</button>
                </div>
            </form>
        </div>

    </div>

</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            console.log("tes123");

            // Ganti gambar mata tergantung pada tipe input
            if (type === 'password') {
                eyeIcon.src = "{{ asset('assets/icons/actionable/eye.svg') }}";
            } else {
                eyeIcon.src = "{{ asset('assets/icons/actionable/eye-slash.svg') }}";
            }
        });
    });
</script>
