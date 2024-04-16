@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Data Baru /
            <span class="tw-font-bold tw-text-b500">Detail Pengajuan</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Pengajuan</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Informasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            @include('components.form.textdetail', [
                                'title' => 'Status Pengajuan',
                                'content' => 'Ditolak',
                                'isLabel' => true,
                            ])
                            @if ($data->status === 'Ditolak')
                                
                            @include('components.form.textdetail', [
                                'title' => 'Catatan',
                                'content' => 'Terdapat kesalahan input data pada nomer kk dan status perkawinan mbak citra. Bisa di benahi dulu dan ajukan ulang',
                                ])
                                @endif

                        </div>
                    </div>

                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-scroll">
                        <h2 class="">Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <table class="tw-w-[702px] md:tw-w-full">
                                {{-- <thead class="tw-rounded-lg"> --}}
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                    <th>NO</th>
                                    <th>NO KK</th>
                                    <th>KEPALA KELUARGA</th>
                                    <th>RT</th>
                                    <th class="tw-w-[108px]"></th>
                                </tr>
                                </thead>
                                <tbody>
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td
                                                class="tw-w-[100px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                                <a href=""
                                                    class="tw-h-10 tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-scroll">
                        <h2 class="">Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <table class="tw-w-[702px] md:tw-w-full">
                                {{-- <thead class="tw-rounded-lg"> --}}
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>NAMA</th>
                                    <th>STATUS KELUARGA</th>
                                    <th class="tw-w-[108px]"></th>
                                </tr>
                                </thead>
                                <tbody>
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td
                                                class="tw-w-[100px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                                <a href=""
                                                    class="tw-h-10 tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>


                <div class="tw-flex tw-justify-between">
                    <a href="{{ route('warga') }}"
                        class="tw-relative tw-min-w-16 tw-flex tw-items-center tw-px-5 tw-h-11 md:tw-pl-12 md:tw-pr-6 tw-border-2 tw-border-n500 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n300 active:tw-border-n1000"
                        type="button">
                        <span
                            class="md:tw-absolute md:tw-top-1/2 md:-tw-translate-y-1/2 md:tw-left-2 tw-flex tw-items-center md:tw-pl-2 tw-cursor-pointer">
                            <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                        </span>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <div class="tw-flex tw-gap-2">
                        <a href=""
                        class="tw-h-11 tw-px-6 tw-bg-n300 tw-text-n1000 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-n400 active:tw-bg-n300 tw-items-center tw-justify-center tw-flex"
                        type="button">Tolak</a>
                        <a href=""
                        class="tw-h-11 tw-px-6 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700 tw-items-center tw-justify-center tw-flex"
                        type="submit">Konfirmasi</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
