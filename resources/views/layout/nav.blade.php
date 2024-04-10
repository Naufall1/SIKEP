@php
    switch (!empty(Auth::user()->hasLevel['level_kode']) ? Auth::user()->hasLevel['level_kode'] : 'Umum') {
        case 'Umum':
            echo '<nav
    class="tw-bg-n100 tw-z-10 tw-h-20 tw-w-svw tw-px-5 md:tw-px-[100px] tw-flex tw-content-center tw-items-center tw-justify-between tw-border-b-[1px] tw-border-n400 tw-fixed">';
            break;

        default:
            echo '<nav
    class="tw-bg-n100 tw-z-10 tw-h-20 tw-w-svw tw-px-5 md:tw-px-5 tw-flex tw-content-center tw-items-center tw-justify-between tw-border-b-[1px] tw-border-n400 tw-fixed">';
            break;
    }
@endphp

<div class="tw-hidden md:tw-flex md:tw-gap-6 tw-items-center">
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
    <div id="navMenus" class="tw-flex tw-gap-3">

        @if (!empty(Auth::user()->hasLevel['level_kode']))

            @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                @include('layout.menu.overview')
            @endif

            @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                @include('layout.menu.penduduk')
            @endif

            @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                @include('layout.menu.pengajuan')
            @endif

            @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                @include('layout.menu.bansos')
            @endif

            @if (Auth::user()->hasLevel['level_kode'] == 'RW')
                @include('layout.menu.admin')
            @endif

            @if (Auth::user()->hasLevel['level_kode'] == 'Admin')
                @include('layout.menu.publikasi')
            @endif

        @endif

    </div>

</div>

<div id="toggleHamburger"
    class="tw-cursor-pointer md:tw-hidden tw-h-11 tw-w-11 tw-flex tw-justify-center tw-items-center hover:tw-bg-n200 tw-rounded-md"
    href="">
    <img class="tw-h-6 tw-bg-cover" src="{{ asset('assets/icons/actionable/hamburger.svg') }}" alt="hamburger icon">
</div>

@if (!empty(Auth::user()->hasLevel['level_kode']))
    <div class="tw-flex tw-gap-3 tw-items-center">
        <div class="nav-notify tw-cursor-pointer tw-h-11 tw-w-11 tw-flex tw-justify-center tw-items-center hover:tw-bg-n200 tw-rounded-md"
            href="">
            <div class="tw-relative">
                <img class="tw-h-6 tw-bg-cover" src="{{ asset('assets/icons/actionable/notification.svg') }}"
                    alt="notification icon">
                <div
                    class="tw-absolute tw-bg-r500 tw-rounded-full tw-h-2 tw-w-2 tw-outline tw-outline-2 tw-outline-n100 tw-top-[2px] -tw-translate-y-1/2 tw-right-[2px]">
                </div>
            </div>
        </div>

        <div class="tw-w-[1.5px] tw-h-8 tw-bg-n300"></div>

        {{-- <div class="tw-h-11"> --}}

        <div id="toggleProfil"
            class="tw-relative nav-profile tw-h-11 tw-min-w-11 tw-justify-center tw-flex md:tw-h-11 md:tw-gap-2 md:tw-px-3 tw-rounded-md tw-items-center tw-cursor-pointer hover:tw-bg-n200">
            <div class="tw-hidden md:tw-inline-block">
                {{-- Nama --}}
                <h3>{{ !empty(Auth::user()->hasLevel['level_kode']) ? Auth::user()->hasLevel['level_kode'] : 'Umum' }}</h3>

                {{-- Keterangan --}}
                {{-- <p class="tw-caption tw-text-n600">
                        {{$text}}
                    </p> --}}
            </div>
            <img id="dropdownProfil" class="tw-h-5 tw-hidden md:tw-inline-block"
                src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}" alt="">
            <img class="tw-h-6 tw-bg-cover md:tw-hidden" src="{{ asset('assets/icons/actionable/profile-circle.svg') }}"
                alt="profile icon">
            <div id="profilMenu"
                class="tw-animate-slide-in tw-absolute tw-hidden tw-top-14 tw-right-0 tw-w-40 tw-border-1 tw-rounded-md tw-border-[1px] tw-bg-n100 tw-divide-y-[1px] tw-divide-n400">
                <div class="tw-flex tw-gap-1 tw-w-full">
                    <a href="{{ route('profil') }}"
                        class="tw-w-full tw-group tw-flex tw-h-10 tw-gap-1 tw-content-center tw-items-center tw-px-3 tw-rounded-t-md active:tw-bg-n300 hover:tw-bg-n200 ">
                        <img class="tw-h-5 tw-bg-cover  " src="/assets/icons/actionable/profile-circle.svg"
                            alt="profile icon">
                        <p class="tw-menu-text tw-text-n1000">Profil</p>
                    </a>
                </div>
                <div class="tw-flex tw-gap-1 tw-w-full">
                    <a href="{{ route('logout') }}"
                        class="tw-w-full tw-group tw-flex tw-h-10 tw-gap-1 tw-content-center tw-items-center tw-px-3 tw-rounded-br-md tw-rounded-bl-md active:tw-bg-n300 hover:tw-bg-n200 ">
                        <img class="tw-h-5 tw-bg-cover  " src="/assets/icons/actionable/logout.svg" alt="profile icon">
                        <p class="tw-menu-text tw-text-r500">Keluar</p>
                    </a>
                </div>
            </div>
        </div>


        {{-- </div> --}}
        {{-- MOBILE --}}
        {{-- <div class="nav-profile tw-cursor-pointer md:tw-hidden tw-h-11 tw-w-11 tw-flex tw-justify-center tw-items-center hover:tw-bg-n200 tw-rounded-md"
            href="">


        </div> --}}

    </div>
@else
    @if (Route::currentRouteName() !== 'login')
        <a href="{{ route('login') }}"
            class="tw-flex tw-items-center tw-h-11 tw-px-6 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
            type="submit">Masuk</a>
    @endif
@endif

</nav>




<div id="modalBg"
    class="modal-menu tw-z-20 tw-animate-disolve tw-hidden tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
    <div
        class="tw-w-11/12 tw-relative tw-top-5 tw-left-1/2 -tw-translate-x-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] tw-stroke-n400">
        <div class="tw-flex tw-justify-between tw-items-center tw-px-4 tw-h-14 tw-border-b-[1px]">
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
            <img id="closeModal" class="tw-opacity-45 tw-cursor-pointer tw-h-6 tw-bg-cover hover:tw-opacity-100"
                src="{{ asset('assets/icons/actionable/close.svg') }}" alt="close icon">
        </div>
        <div id="navMenus" class="tw-flex tw-gap-4 tw-w-full tw-flex-col tw-p-4">

            @if (!empty(Auth::user()->hasLevel['level_kode']))

                @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                    @include('layout.menu.overview')
                @endif

                @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                    @include('layout.menu.penduduk')
                @endif

                @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                    @include('layout.menu.pengajuan')
                @endif

                @if (Auth::user()->hasLevel['level_kode'] == 'RW' || Auth::user()->hasLevel['level_kode'] == 'RT')
                    @include('layout.menu.bansos')
                @endif

                @if (Auth::user()->hasLevel['level_kode'] == 'RW')
                    @include('layout.menu.admin')
                @endif

                @if (Auth::user()->hasLevel['level_kode'] == 'Admin')
                    @include('layout.menu.publikasi')
                @endif

            @endif
        </div>
    </div>
</div>


<script>
    // $(document).ready( function() {
    //     $("#toggleHamburger" ).click(function() {
    //         $("#modalMenu").removeClass("tw-hidden")
    //     })
    // });

    document.addEventListener('DOMContentLoaded', function() {
        const toggleHamburger = document.getElementById('toggleHamburger');
        const modalBg = document.getElementById('modalBg');
        // const eyeIcon = document.getElementById('eyeIcon');

        toggleHamburger.addEventListener('click', function() {
            modalBg.classList.remove('tw-hidden');
        });

        const closeModal = document.getElementById('closeModal');

        closeModal.addEventListener('click', function() {
            modalBg.classList.add('tw-hidden');
        });

        modalBg.addEventListener('click', function() {
            modalBg.classList.add('tw-hidden');
        });

        const toggleProfil = document.getElementById('toggleProfil');
        const dropdownProfil = document.getElementById('dropdownProfil');
        toggleProfil.addEventListener('click', function() {
            profilMenu.classList.toggle('tw-hidden');
            dropdownProfil.classList.toggle('tw-rotate-180');
        });

        const navMenus = document.getElementById('navMenus');
        const navMenuLinks = Array.from(navMenus.children);

        navMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                console.log('tes');
                navMenuLinks.forEach(function() {
                    item => item.classList.remove('active')
                }); // Remove active class from all links
                this.classList.add('active'); // Add active class to the clicked link
            });
        });

    });
</script>
