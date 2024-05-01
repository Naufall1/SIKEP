@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-px-5 md:tw-px-[100px] tw-pt-[100px] tw-flex tw-flex-col">
        {{-- beranda --}}
        <div class="tw-flex tw-flex-col tw-pt-16 tw-items-center tw-gap-24">
            <div class="tw-flex tw-flex-col tw-items-center sm:tw-w-11/12 md:tw-w-full tw-gap-8">
                <h1 class="tw-font-sans tw-font-semibold tw-text-[44px] md:tw-text-[52px] tw-text-center tw-leading-snug">
                    Sistem Kependudukan <span class="tw-text-b500">RW02</span> Kelurahan Gadingkasri</h1>
                <p class="tw-font-sans tw-font-medium tw-text-base md:tw-text-xl tw-text-n700 tw-text-center">Kemudahan Akses
                    Informasi Kependudukan Kapanpun Dimanapun</p>
            </div>
            <img class="tw-w-full md:tw-w-11/12" src="{{ asset('assets/landing/sikep-landing.png') }}" alt="">
        </div>
        {{-- / beranda --}}
        {{-- visi misi --}}
        <div class="tw-flex tw-flex-col tw-py-12 tw-items-center tw-gap-10">
            <div class="tw-flex tw-flex-col tw-items-center sm:tw-w-11/12 md:tw-w-full tw-gap-2">
                <h1 class="tw-font-sans tw-font-semibold tw-text-[32px] md:tw-text-[44px] tw-text-center tw-leading-snug">
                    Visi Misi</h1>
                <p class="tw-font-sans tw-font-medium tw-text-base md:tw-text-xl tw-text-n700 tw-text-center">Tujuan bersama
                    yang dicapai bersama-sama</p>
            </div>
            <div class="tw-flex tw-flex-col tw-gap-5 tw-w-full">
                <div
                    class="tw-flex tw-gap-5 tw-h-fit tw-p-4 tw-w-full tw-bg-n100 tw-rounded-xl tw-border-[1.5px] tw-border-n100 hover:tw-border-n400">
                    <div class="tw-w-1 tw-rounded-full tw-bg-b500"></div>
                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h3 class="tw-text-2xl">Visi</h3>
                        <p class="tw-font-sans tw-font-medium tw-text-lg tw-text-n700">Menuju RW 02 yang lebih maju dan
                            harmonis</p>
                    </div>
                </div>
                <div
                    class="tw-flex tw-gap-5 tw-h-fit tw-p-4 tw-w-full tw-bg-n100 tw-rounded-xl tw-border-[1.5px] tw-border-n100 hover:tw-border-n400">
                    <div class="tw-w-1 tw-rounded-full tw-bg-b500"></div>
                    <div class="tw-flex tw-w-fit tw-grow tw-flex-col tw-gap-2">
                        <h3 class="tw-text-2xl">Misi</h3>
                        <p class="tw-font-sans tw-grow tw-font-medium tw-text-lg tw-text-n700">Meningkatkan serta memelihara
                            kerukunan warga, sehingga tercipta tatanan masyarakat yang adil, damai, dan sejahtera</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- / visi misi --}}
        {{-- Profil Singkat --}}
        <div class="tw-flex tw-flex-col tw-py-12 tw-items-center tw-gap-10">
            <div class="tw-flex tw-flex-col tw-items-center sm:tw-w-11/12 md:tw-w-full tw-gap-2">
                <h1 class="tw-font-sans tw-font-semibold tw-text-[32px] md:tw-text-[44px] tw-text-center tw-leading-snug">
                    Profil Singkat</h1>
                <p class="tw-font-sans tw-font-medium tw-text-base md:tw-text-xl tw-text-n700 tw-text-center">RW 02
                    merupakan salah satu dari 6 RW yang ada di Kelurahan Gadingkasri, Kecamatan Klojen, Kota Malang</p>
            </div>
            <div class="tw-grid tw-grid-cols-2 tw-gap-5 tw-w-full">
                <div class="tw-col-span-2 tw-rounded-xl tw-w-full tw-overflow-hidden">
                    <iframe class=" tw-w-full tw-aspect-video" {{-- width="560" height="315" --}}
                        src="https://www.youtube.com/embed/QQrEQOifXUc?si=WGpvA23_S8nUn97W" title="Profil RW 02"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div
                    class="tw-col-span-2 md:tw-col-span-1 tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-p-4 tw-rounded-xl tw-flex tw-flex-col tw-gap-5">
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-flex tw-items-center tw-justify-center tw-h-11 tw-w-11 tw-bg-b50 tw-rounded-md">
                            <x-icons.actionable.people-1 class="tw-stroke-b500" color="b500" size="24" stroke="1.5"></x-icons.actionable.people-1>
                        </div>
                        <h2 class="tw-text-xl">Penduduk</h2>
                    </div>
                    <p class="tw-font-sans tw-font-medium tw-text-lg tw-text-n1000">Wilayah RW 02 terdiri dari 11 Rukun
                        Tetangga. Terdapat XXX KK dengan XXXX Warga yang hidup dilingkungan RW 02. Luas wilayah RW 02 yaitu
                        116.108.45 meter persegi.</p>
                </div>
                <div
                    class="tw-col-span-2 md:tw-col-span-1 tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-p-4 tw-rounded-xl tw-flex tw-flex-col tw-gap-5">
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-flex tw-items-center tw-justify-center tw-h-11 tw-w-11 tw-bg-b50 tw-rounded-md">
                            <x-icons.actionable.tag-user class="tw-stroke-b500" color="b500" size="24" stroke="1.5"></x-icons.actionable.tag-user>
                        </div>
                        <h2 class="tw-text-xl">Program</h2>
                    </div>
                    <p class="tw-font-sans tw-font-medium tw-text-lg tw-text-n1000">RW 02 memiliki kewirausahaan seperti
                        pasar pagi, toko dan aneka sembako, bengkel, dan lain-lain. Selain kewirausahaan, RW 02 juga
                        menggali potensi yang ada seperti budidaya tanaman sayur dan lele, UMKM RW 02, bank sampah, dan
                        lain-lain.</p>
                </div>
            </div>
        </div>
        {{-- / Profil Singkat --}}
    </div>
    <div class="tw-px-5 md:tw-px-[100px] tw-flex tw-flex-col tw-bg-n200">
        {{-- Informasi Grafik --}}
        <div class="tw-flex tw-flex-col tw-pt-12 tw-pb-16 tw-items-center tw-gap-10">
            <div class="tw-flex tw-flex-col tw-items-center sm:tw-w-11/12 md:tw-w-full tw-gap-2">
                <h1 class="tw-font-sans tw-font-semibold tw-text-[32px] md:tw-text-[44px] tw-text-center tw-leading-snug">
                    Informasi Grafik</h1>
                    <p class="tw-font-sans tw-font-medium tw-text-base md:tw-text-xl tw-text-n700 tw-text-center">Menyajikan
                        informasi yang terupdate tentang RW 02 tiap bulannya</p>
                    </div>
                    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-h-full tw-w-full">
                        <div
                        class="tw-p-4 tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-h-80 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                        {{-- @include('dashboard.chart.pekerjaan') --}}
                </div>
                <div
                    class="tw-p-4 tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-h-80 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                    {{-- @include('dashboard.chart.pekerjaan') --}}
                </div>
                <div
                class="tw-p-4 tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-h-80 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                    {{-- @include('dashboard.chart.pekerjaan') --}}
                </div>
                <div
                    class="tw-p-4 tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-h-80 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                    {{-- @include('dashboard.chart.pekerjaan') --}}
                </div>
                {{-- @include('dashboard.chart.jenisKelamin') --}}
            </div>
        </div>
        {{-- / Informasi Grafik --}}
    </div>
    <div class="tw-px-5 md:tw-px-[100px] tw-flex tw-flex-col">
        {{-- Publikasi Artikel dan Pengumuman --}}
        <div class="tw-flex tw-flex-col tw-py-12 tw-items-center tw-gap-10">
            <div class="tw-flex tw-flex-col tw-items-center sm:tw-w-11/12 md:tw-w-full tw-gap-2">
                <h1 class="tw-font-sans tw-font-semibold tw-text-[32px] md:tw-text-[44px] tw-text-center tw-leading-snug">
                    Publikasi Artikel dan Pengumuman</h1>
            </div>
            <div class="tw-grid tw-grid-cols-6 tw-gap-4 tw-w-full">
                <x-cards.publication url="#" image="dummy" type="artikel"
                    title="Tante Kumat dan Taman Sale Bikin RW 2 Gadingkasri Jadi Asri" writer="Shuvia Rahma"
                    date="Jumat, 16 Oktober 2020"></x-cards.publication>
                <x-cards.publication url="#" image="dummy" type="pengumuman"
                    title="Tante Kumat dan Taman Sale Bikin RW 2 Gadingkasri Jadi Asri" writer="Shuvia Rahma"
                    date="Jumat, 16 Oktober 2020"></x-cards.publication>
                <x-cards.publication url="#" image="dummy" type="artikel"
                    title="Tante Kumat dan Taman Sale Bikin RW 2 Gadingkasri Jadi Asri" writer="Shuvia Rahma"
                    date="Jumat, 16 Oktober 2020"></x-cards.publication>
                <x-cards.publication url="#" image="dummy" type="artikel"
                    title="Tante Kumat dan Taman Sale Bikin RW 2 Gadingkasri Jadi Asri" writer="Shuvia Rahma"
                    date="Jumat, 16 Oktober 2020"></x-cards.publication>
                <x-cards.publication url="#" image="dummy" type="artikel"
                    title="Tante Kumat dan Taman Sale Bikin RW 2 Gadingkasri Jadi Asri" writer="Shuvia Rahma"
                    date="Jumat, 16 Oktober 2020"></x-cards.publication>
                <x-cards.publication url="#" image="dummy" type="artikel"
                    title="Tante Kumat dan Taman Sale Bikin RW 2 Gadingkasri Jadi Asri" writer="Shuvia Rahma"
                    date="Jumat, 16 Oktober 2020"></x-cards.publication>
    
            </div>
        </div>
        {{-- / Publikasi Artikel dan Pengumuman --}}
    </div>
@endsection

@section('footer')
    @include('layout.footer')
@endsection
