@php
    switch (!empty(Auth::user()->hasLevel['level_kode']) ? Auth::user()->hasLevel['level_kode'] : 'Umum') {
        case 'Umum':
            echo '<nav
    class="tw-bg-n100 tw-z-30 tw-h-20 tw-w-svw tw-px-5 md:tw-px-[100px] tw-flex tw-content-center tw-items-center tw-justify-between tw-border-b-[1.5px] tw-border-n400 tw-fixed">';
            break;

        default:
            echo '<nav
    class="tw-bg-n100 tw-z-30 tw-h-20 tw-w-svw tw-px-5 md:tw-px-5 tw-flex tw-content-center tw-items-center tw-justify-between tw-border-b-[1.5px] tw-border-n400 tw-fixed">';
            break;
    }
@endphp

<div
    class="{{ empty(Auth::user()->hasLevel['level_kode']) ? 'tw-flex' : 'tw-hidden lg:tw-flex' }} md:tw-gap-6 tw-items-center">
    <a href="{{ route('home') }}">
        <x-icons.actionable.logo-sikep></x-icons.actionable.logo-sikep>
    </a>
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
    class="tw-cursor-pointer {{ empty(Auth::user()->hasLevel['level_kode']) ? 'tw-hidden' : 'lg:tw-hidden' }} tw-h-11 tw-w-11 tw-flex tw-justify-center tw-items-center hover:tw-bg-n200 tw-rounded-md"
    href="">
    <x-icons.actionable.hamburger class="tw-bg-cover" stroke="1.5" color="n1000"></x-icons.actionable.hamburger>
</div>

@if (!empty(Auth::user()->hasLevel['level_kode']))
    <div class="tw-flex tw-gap-3 tw-items-center">
        <div class="nav-notify tw-cursor-pointer tw-h-11 tw-w-11 tw-flex tw-justify-center tw-items-center hover:tw-bg-n200 tw-rounded-md"
            href="">
            <div class="tw-relative tw-flex tw-justify-center">
                <x-icons.actionable.notification class="tw-bg-cover" stroke="1.5"
                    color="n1000"></x-icons.actionable.notification>
                <div
                    class="tw-absolute tw-bg-r500 tw-rounded-full tw-h-2 tw-w-2 tw-outline tw-outline-2 tw-outline-n100 tw-top-[2px] -tw-translate-y-1/2 tw-right-[2px]">
                </div>
            </div>
        </div>

        <div class="tw-w-[1.5px] tw-h-8 tw-bg-n300"></div>

        {{-- <div class="tw-h-11"> --}}

        <div
            class="tw-relative nav-profile tw-h-11 tw-min-w-11 tw-justify-center tw-flex md:tw-h-11 md:tw-gap-2 tw-rounded-md">
            <div id="toggleProfil"
                class="tw-h-11 tw-min-w-11 tw-justify-center tw-flex md:tw-h-11 md:tw-gap-2 md:tw-px-3 tw-rounded-md tw-items-center tw-cursor-pointer hover:tw-bg-n200">

                <div class="tw-hidden md:tw-inline-block">
                    {{-- Nama --}}
                    <h3>{{ !empty(Auth::user()->hasLevel['level_kode']) ? Auth::user()->hasLevel['level_kode'] : 'Umum' }}
                        
                    </h3>

                    {{-- Keterangan --}}
                    {{-- <p class="tw-caption tw-text-n600">
                        {{$text}}
                    </p> --}}
                </div>
                <x-icons.actionable.arrow-down-1 id="dropdownProfil" class="tw-hidden md:tw-inline-block tw-animate-180"
                    stroke="2" size="24" color="n1000"></x-icons.actionable.arrow-down-1>
                <x-icons.actionable.profile-circle class="tw-bg-cover md:tw-hidden" stroke="1.5"
                    color="n1000"></x-icons.actionable.profile-circle>
            </div>
            <div id="profilMenu"
                class="tw-animate-slide-in tw-absolute tw-hidden tw-top-14 tw-right-0 tw-w-40 tw-border-1 tw-rounded-md tw-border-[1px] tw-bg-n100 tw-divide-y-[1px] tw-divide-n400">
                <div class="tw-flex tw-gap-1 tw-w-full">
                    <a href="{{ route('profil') }}"
                        class="tw-w-full tw-group tw-flex tw-h-10 tw-gap-1 tw-content-center tw-items-center tw-px-3 tw-rounded-t-md active:tw-bg-n300 hover:tw-bg-n200 ">
                        <x-icons.actionable.profile-circle stroke="2" size="20"
                            color="n1000"></x-icons.actionable.profile-circle>
                        <p class="tw-menu-text tw-text-n1000">Profil</p>
                    </a>
                </div>
                <div class="tw-flex tw-gap-1 tw-w-full">
                    <a href="{{ route('logout') }}"
                        class="tw-w-full tw-group tw-flex tw-h-10 tw-gap-1 tw-content-center tw-items-center tw-px-3 tw-rounded-br-md tw-rounded-bl-md active:tw-bg-n300 hover:tw-bg-n200 ">
                        <x-icons.actionable.logout class="tw-stroke-r500" stroke="2" size="20"
                            color="r500"></x-icons.actionable.logout>
                        <p class="tw-menu-text tw-text-r500">Keluar</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@else
    @if (Route::currentRouteName() !== 'login')
        <a href="{{ route('login') }}" class="tw-btn tw-btn-lg tw-btn-primary tw-btn-round" type="submit">Masuk</a>
    @endif
@endif

</nav>

<div id="modalBg"
    class="modal-menu tw-z-20 tw-animate-disolve tw-hidden tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
    <div
        class="tw-w-11/12 tw-relative tw-top-5 tw-left-1/2 -tw-translate-x-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] ">
        <div class="tw-flex tw-justify-between tw-items-center tw-px-4 tw-h-14 tw-border-b-[1px]">
            <a href="{{ route('home') }}">
                <x-icons.actionable.logo-sikep></x-icons.actionable.logo-sikep>
            </a>
            <x-icons.actionable.close id="closeModal" class="tw-cursor-pointer" stroke="2" size="24"
                color="n1000"></x-icons.actionable.close>
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
