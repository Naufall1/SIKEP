@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div id="modalConfirm"
        class="tw-hidden modal-menu tw-px-5 md:tw-px-0 tw-z-40 tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
        <div
            class="tw-w-mobile-full-w md:tw-w-2/4 tw-relative tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] ">
            <div id="navMenus" class="tw-flex tw-gap-4 tw-w-full tw-flex-col tw-p-4">
                <div class="tw-flex tw-flex-col tw-gap-7 tw-items-end">
                    <div class="tw-flex tw-w-full tw-flex-col tw-gap-2">

                        <h2>Tetap Ubah Data?</h2>
                        <p class="tw-body tw-text-n800">Anda telah melakukan pengajuan perubahan pada data keluarga ini. Data
                            yang sedang diajukan dapat Anda ubah kembali.
                        </p>
                    </div>

                    <div class="tw-flex tw-gap-2">
                        <button class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                            id="closeModalConfirm">Batal</button>
                        <a href="{{ route('keluarga-edit', ['no_kk' => $keluarga->no_kk]) }}"
                            class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Perbarui</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div
        class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        {{-- @dd($pengajuanInProgres) --}}
        @if ($pengajuanInProgres)
            <x-flash-message.warning message='Anda sedang melakukan pengajuan pada keluarga ini!'></x-flash-message.warning>
        @endif
        <p class="tw-breadcrumb tw-text-n500">Daftar Keluarga /
            <span class="tw-font-bold tw-text-b500">Detail Keluarga</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : '' }}  tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Keluarga</h1>
                @if (Auth::user()->hasLevel['level_kode'] == 'RT')
                    @if (!$pengajuanInProgres)
                        <a href="{{ route('keluarga-edit', ['no_kk' => $keluarga->no_kk]) }}"
                            class="tw-btn tw-btn-primary tw-btn-md-ilead tw-rounded-full">
                            <x-icons.actionable.edit class="" stroke="2" size="20"
                                color="n100"></x-icons.actionable.edit>
                            <span class="">
                                Perbarui
                            </span>
                        </a>
                    @else
                        <button id="buttonConfirm" class="tw-btn tw-btn-primary tw-btn-md-ilead tw-rounded-full">
                            <x-icons.actionable.edit class="" stroke="2" size="20"
                                color="n100"></x-icons.actionable.edit>
                            <span class="">
                                Perbarui
                            </span>
                        </button>
                    @endif
                @endif
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div
                        class="tw-flex tw-flex-col tw-gap-2 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">
                        <h2 class="">Detail Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'No KK',
                                'content' => $keluarga->no_kk,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kepala Keluarga',
                                'content' => $keluarga->kepala_keluarga,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Alamat',
                                'content' => $keluarga->alamat,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kode POS',
                                'content' => $keluarga->kode_pos,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'RT',
                                'content' => $keluarga->RT,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'RW',
                                'content' => $keluarga->RW,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kelurahan',
                                'content' => $keluarga->kelurahan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kecamatan',
                                'content' => $keluarga->kecamatan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kota',
                                'content' => $keluarga->kota,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Provinsi',
                                'content' => $keluarga->provinsi,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kartu Keluarga',
                                'isImage' => true,
                                'content' => !isset($keluarga->image_kk)
                                    ? ''
                                    : asset(Storage::disk('public')->url('KK/' . $keluarga->image_kk)),
                            ]) {{-- kalau label kasih value var $isLabel with true --}}


                        </div>
                    </div>

                    <div
                        class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[400ms]">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Tagihan Listrik',
                                'content' => 'Rp ' . number_format($keluarga->tagihan_listrik, 0, ',', '.'),
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Luas Bangunan',
                                'content' => $keluarga->luas_bangunan . ' m²',
                            ])

                        </div>
                    </div>

                    <div
                        class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[600ms]">
                        <h2 class="">Anggota Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-w-full tw-gap-3 tw-overflow-x-auto">

                            <table class="tw-table-fixed tw-w-[701px]" id="daftarWarga">
                                <thead class="">
                                    <tr class="">
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Status Keluarga</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($keluarga->warga as $warga)
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$warga->NIK}}</td>
                                            <td>{{$warga->nama}}</td>
                                            <td>{{$warga->status_keluarga}}</td>
                                            <td
                                                class="tw-w-[140px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                                <a href="{{route('wargaDetail', $warga->NIK)}}"
                                                    class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div
                        class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[800ms]">
                        <h2 class="">Daftar Bansos</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3 tw-w-full tw-overflow-x-auto ">

                            <table class=" tw-table-fixed tw-w-[701px]" id="daftarBansos">
                                <thead class="">
                                    <tr class="">
                                        <th>No</th>
                                        <th>Nama Bansos</th>
                                        <th>Tanggal Menerima</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @for ($i = 0; $i < count($keluarga->bansos); $i++)
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $keluarga->bansos[$i]->bansos_nama }}</td>
                                            <td>{{ $keluarga->detailBansos[$i]->tanggal_menerima }}</td>
                                            <td>{{$keluarga->bansos[$i]->keterangan}}</td>
                                            <td>-</td>
                                        </tr>
                                    @endfor --}}
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>


                <div
                    class="tw-flex tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[1000ms]">
                    <a href="{{ route('keluarga') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                        type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>
    @if (Session::has('message'))
        <script>
            alert('{{ Session::get('message')[1] }}')
        </script>
    @endif
@endsection


@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            dataWarga = $('#daftarWarga').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('penduduk.keluarga.detail.listWarga', ['no_kk' => $keluarga->no_kk]) }}",
                    "dataType": "json",
                    "type": "POST",
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 tw-flex");
                },
                drawCallback: function() {
                    $('.table.dataTable').css('border-collapse', 'collapse');
                },
                paging: false,
                info: false,
                searching: false,
                // order: [
                //     [2, 'asc']
                // ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                    searchable: false
                }, {
                    data: "NIK",
                    className: "tw-min-w-[132px] tw-grow tw-shrink",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama",
                    className: "tw-min-w-[126px] tw-grow tw-shrink",
                    orderable: true,
                    searchable: false
                }, {
                    data: "status_keluarga",
                    className: "tw-min-w-[174px] tw-max-w-[174px]",
                    orderable: false,
                    searchable: false
                }, {
                    data: "action",
                    className: "tw-min-w-[76px] tw-max-w-[76px] tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }],
                columnDefs: [{
                    targets: [1, 2],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });
            dataBansos = $('#daftarBansos').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('penduduk.keluarga.detail.listBansos', ['no_kk' => $keluarga->no_kk]) }}",
                    "dataType": "json",
                    "type": "POST",
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 tw-flex");
                },
                drawCallback: function() {
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none" viewBox="0 0 150 151">
                        <g clip-path="url(#a)">
                            <path fill="#E3E3E3" d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z"/>
                            <path fill="#fff" d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z"/>
                            <path fill="#0284FF" d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z"/>
                            <path fill="#fff" d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z"/>
                            <path fill="#CCE4FF" d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z"/>
                        </g>
                        <defs>
                            <clipPath id="a">
                            <rect width="150" height="150" y=".5" fill="#fff" rx="75"/>
                            </clipPath>
                        </defs>
                        </svg>
                        <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                    `);
                },
                paging: false,
                info: false,
                searching: false,
                order: [
                    [2, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                    searchable: false
                }, {
                    data: "bansos_nama",
                    className: "tw-min-w-[146px] tw-grow tw-shrink",
                    orderable: true,
                    searchable: false
                }, {
                    data: "tanggal_menerima",
                    className: "tw-min-w-[200px] tw-max-w-[200px] tw-table-right-align",
                    orderable: true,
                    searchable: false
                }, {
                    data: "keterangan",
                    className: "tw-min-w-[188px] tw-max-w-[188px]",
                    orderable: false,
                    searchable: false
                }],
                columnDefs: [{
                    targets: [1, 3],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });
        });
    </script>
@endpush

@if ($pengajuanInProgres)
    @push('js')
        <script>
            $(document).ready(function () {
                $("#buttonConfirm").click(function() {
                $("#modalConfirm").removeClass("tw-hidden");
                $('html, body').css({
                    overflow: 'hidden',
                });
            });

            $("#closeModalConfirm").click(function() {
                $("#modalConfirm").addClass("tw-hidden");
                $('html, body').css({
                    overflow: 'auto',
                });
            });
            });
        </script>
    @endpush
@endif