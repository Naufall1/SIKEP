@extends('layout.layout', ['isForm' => true])
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <div class="tw-pt-[80px] tw-flex tw-flex-col">
        {{-- beranda --}}
        <section id="home"
            class="tw-px-5 md:tw-px-0 tw-flex tw-flex-col tw-h-mobile-hero sm:tw-h-svh tw-pt-16 tw-items-center tw-gap-24 tw-relative tw-bg-cover tw-bg-top sm:tw-bg-center tw-bg-[url('/public/img/hero-landing.png')] sm:tw-bg-[url('/public/img/hero-landing-md.png')]">
            <div
                class=" tw-flex tw-flex-col tw-items-center tw-w-full-mobile-w md:tw-w-full-mobile-w lg:tw-w-[868px] tw-gap-5">
                <h1 class="tw-font-sans tw-font-semibold tw-text-[44px] md:tw-text-[60px] tw-text-center tw-leading-snug">
                    Sistem Informasi Kependudukan <span class="tw-text-b500">RW 02</span></h1>
                <p class="tw-font-sans tw-font-medium tw-text-base md:tw-text-xl tw-text-n1000 tw-opacity-40 tw-text-center">
                    Kemudahan Akses
                    Informasi Kependudukan Kapanpun Dimanapun</p>
            </div>
            {{-- <img class="-tw-z-20 tw-absolute tw-bottom-0 md:tw-h-1/2 lg:tw-h-3/4 tw-object-cover" src="{{ asset('assets/landing/sikep-landing2.png') }}" alt=""> --}}
            {{-- <div class="-tw-z-10 tw-absolute tw-bottom-0 tw-w-full tw-h-[433px] tw-bg-gradient-to-t tw-from-n100 tw-to-transparent"></div> --}}
        </section>
        {{-- / beranda --}}
        {{-- visi misi --}}
        <section id="about" class="tw-px-5 md:tw-px-[100px] tw-flex tw-flex-col tw-py-12 tw-items-center tw-gap-10">
            <x-landing.label-group>
                <x-landing.label>Tentang RW 02</x-landing.label>
                <x-landing.title-group>
                    <x-landing.title>Yang Harus Kamu Tahu<br>Tentang <span class="tw-text-b500">RW
                            02</span></x-landing.title>
                    <x-landing.subtitle>Komitmen dalam Pelestarian Lingkungan dan Kerukunan</x-landing.subtitle>
                </x-landing.title-group>
            </x-landing.label-group>
            <div class="tw-grid tw-gap-4 tw-grid-cols-8 tw-w-full">
                <div class="tw-flex tw-flex-col tw-col-span-8 sm:tw-col-span-8 lg:tw-col-span-5 tw-w-full tw-gap-4">
                    <div
                        class="tw-flex tw-flex-col tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-p-4 tw-rounded-xl tw-gap-5">
                        <div class="tw-flex tw-flex-col tw-gap-4">
                            <h5 class="tw-font-sans tw-font-semibold tw-text-2xl tw-text-n1000">Jumlah Penduduk</h5>
                            <p class="tw-font-sans tw-font-medium tw-text-sm tw-text-n1000 tw-opacity-35">RW 02 merupakan
                                salah satu RW dari sekian RW di Kelurahan Gadingkasri. RW 02 terdiri dari 11 Rukun Tetangga
                                (RT). Terdapat 880 KK dengan 1600 warga yang tinggal dilingkungan RW 02.</p>
                        </div>
                        <div
                            class="tw-bg-n500 tw-h-[176px] tw-rounded-lg tw-w-full tw-bg-cover tw-bg-center tw-bg-[url('/public/img/penduduk.png')]">
                        </div>
                    </div>
                    <div
                        class="tw-flex tw-flex-col tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-p-4 tw-rounded-xl tw-gap-5">
                        <div class="tw-flex tw-flex-col tw-gap-4">
                            <h5 class="tw-font-sans tw-font-semibold tw-text-2xl tw-text-n1000">Program</h5>
                            <p class="tw-font-sans tw-font-medium tw-text-sm tw-text-n1000 tw-opacity-35">Masyarakat RW 02
                                memiliki beberapa wirausaha seperti pasar pagi, toko dan aneka sembako, dan bengkel. Selain
                                kewirausahaan, RW 02 juga menggali potensi yang ada seperti budidaya tanaman sayur dan lele,
                                UMKM RW 02, dan bank sampah.</p>
                        </div>
                        <div
                            class="tw-bg-n500 tw-h-[176px] tw-rounded-lg tw-w-full tw-bg-cover tw-bg-center tw-bg-[url('/public/img/program.png')]">
                        </div>
                    </div>
                </div>
                <div
                    class="tw-flex tw-flex-col tw-col-span-8 sm:tw-col-span-8 lg:tw-col-span-3 tw-w-full tw-h-[664px] tw-gap-4 md:tw-h-full">
                    <div class="tw-flex tw-flex-col tw-col-span-5 tw-w-full tw-gap-4 tw-h-full">
                        <div
                            class="tw-flex tw-flex-col tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-p-4 tw-rounded-xl tw-gap-5 tw-h-full">
                            <div class="tw-flex tw-flex-col tw-gap-4">
                                <h5 class="tw-font-sans tw-font-semibold tw-text-2xl tw-text-n1000">Luas Wilayah</h5>
                                <p class="tw-font-sans tw-font-medium tw-text-sm tw-text-n1000 tw-opacity-35">Masyarakat RW
                                    02 memiliki beberapa wirausaha seperti pasar pagi, toko dan aneka sembako, dan bengkel.
                                    Selain kewirausahaan, RW 02 juga menggali potensi yang ada seperti budidaya tanaman
                                    sayur dan lele, UMKM RW 02, dan bank sampah.</p>
                            </div>
                            <div
                                class="tw-bg-n500 tw-h-full tw-rounded-lg tw-w-full tw-bg-cover tw-bg-center tw-bg-[url('/public/img/wilayah.png')]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- / visi misi --}}
        {{-- Profil Singkat --}}
        <section id="profile" class="tw-px-5 md:tw-px-[100px] tw-flex tw-flex-col tw-py-12 tw-items-center tw-gap-10">
            <x-landing.label-group>
                <x-landing.label>Video Profil</x-landing.label>
                <x-landing.title-group>
                    <x-landing.title>Profil Singkat <span class="tw-text-b500">RW
                            02</span></x-landing.title>
                    <x-landing.subtitle>Video Profil RW 02</x-landing.subtitle>
                </x-landing.title-group>
            </x-landing.label-group>
            <div class="tw-grid tw-grid-cols-2 tw-gap-5 tw-w-full">
                <div class="tw-col-span-2 tw-rounded-xl tw-w-full tw-overflow-hidden">
                    <iframe class=" tw-w-full tw-aspect-video" {{-- width="560" height="315" --}}
                        src="https://www.youtube.com/embed/QQrEQOifXUc?si=WGpvA23_S8nUn97W" title="Profil RW 02"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </section>

        {{-- / Profil Singkat --}}

        {{-- Informasi Grafik --}}
        <section id="chart" class="tw-bg-n300 tw-relative tw-bg-gradient-to-b tw-from-n100 tw-via-transparent tw-to-n100">
            <div class="tw-z-20 tw-px-5 md:tw-px-[100px] tw-w-full tw-flex tw-flex-col tw-py-12 tw-items-center tw-gap-10 ">
                <x-landing.label-group>
                    <x-landing.label>Grafik</x-landing.label>
                    <x-landing.title-group>
                        <x-landing.title><span class="tw-text-b500">RW
                                02</span> Dalam Angka</x-landing.title>
                        <x-landing.subtitle>Informasi perkembangan masyarakat di lingkungan RW 02</x-landing.subtitle>
                    </x-landing.title-group>
                </x-landing.label-group>
                <div class="tw-w-full tw-flex tw-flex-col tw-items-center tw-gap-10">

                    <div class="tw-grid tw-grid-cols-8 tw-justify-center tw-gap-4 tw-h-full tw-w-full">
                        <x-cards.chart class="tw-overflow-x-auto tw-col-span-8 lg:tw-col-span-4">
                            @include('dashboard.chart.lineChart')
                        </x-cards.chart>
                        <x-cards.chart class="tw-overflow-x-auto tw-col-span-8 lg:tw-col-span-4">
                            @include('dashboard.chart.barChart')
                        </x-cards.chart>
                        <x-cards.chart class="tw-overflow-x-auto tw-col-span-8 lg:tw-col-start-3 lg:tw-col-span-4">
                            @include('dashboard.chart.pieChart')
                            {{-- <iframe width="600" height="450" src="https://lookerstudio.google.com/embed/reporting/02f7484e-e5b8-446a-9b5d-a647347e903d/page/p_tymcma0zhd" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe> --}}
                        </x-cards.chart>
                    </div>
                </div>
            </div>
            {{-- <div class="tw-absolute tw-top-0 tw-w-full tw-h-[300px] tw-bg-gradient-to-b tw-from-n1000 tw-to-transparent"></div> --}}
            {{-- <div class="tw-absolute tw-bottom-0 tw-w-full tw-h-[300px] tw-bg-gradient-to-t tw-from-n1000 tw-to-transparent"></div> --}}
        </section>
        {{-- / Informasi Grafik --}}
        <section id="information" class="tw-px-5 md:tw-px-[100px] tw-flex tw-flex-col">
            {{-- Publikasi Artikel dan Pengumuman --}}
            <div class="tw-flex tw-flex-col tw-py-12 tw-items-center tw-gap-10">
                <x-landing.label-group>
                    <x-landing.label>Informasi</x-landing.label>
                    <x-landing.title-group>
                        <x-landing.title>Publikasi Pengumuman</x-landing.title>
                        <x-landing.subtitle>Informasi terkini yang mencakup kegiatan dan perkembangan terbaru di lingkungan RW
                            02</x-landing.subtitle>
                    </x-landing.title-group>
                </x-landing.label-group>
                <div class="tw-grid tw-grid-cols-6 tw-gap-4 tw-w-full">
                    @if ($announcements->isEmpty())
                        <div class="tw-col-span-6 tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-7 tw-pb-16">
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none"
                                viewBox="0 0 150 151">
                                <g clip-path="url(#a)">
                                    <path fill="#E3E3E3"
                                        d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z" />
                                    <path fill="#fff"
                                        d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z" />
                                    <path fill="#0284FF"
                                        d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z" />
                                    <path fill="#fff"
                                        d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z" />
                                    <path fill="#CCE4FF"
                                        d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z" />
                                </g>
                                <defs>
                                    <clipPath id="a">
                                        <rect width="150" height="150" y=".5" fill="#fff" rx="75" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <p class="tw-placeholder tw-font-semibold tw-text-base">Tidak Ada Pengumuman</p>
                        </div>
                    @else
                        @foreach ($announcements as $announcement)
                            <x-cards.publication url="{{ route('home.baca', ['id' => $announcement->kode]) }}"
                                image="{{ $announcement->image_url }}" type="{{ $announcement->kategori }}"
                                title="{{ $announcement->judul }}" writer="{{ $announcement->penulis }}"
                                day="{{ Carbon::parse($announcement->tanggal_dibuat)->locale('id')->translatedFormat('l') }}"
                                date="{{ Carbon::parse($announcement->tanggal_dibuat)->locale('id')->translatedFormat('d F Y') }}"></x-cards.publication>
                        @endforeach
                    @endif
                </div>
            </div>
            
        </section>
    </div>
@endsection

@section('footer')
    @include('layout.footer')
@endsection


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
