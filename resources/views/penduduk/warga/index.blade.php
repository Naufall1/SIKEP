@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush



@section('content')
    {{-- canEdit = if RW => False, RT => False --}}
    {{-- @include('layout.tableset',['pageTitle' => 'Daftar Penduduk',  'canEdit' => true, 'topMenu' => [
        ['title' => 'Warga', 'url' => '#'],
        ['title' => 'Keluarga', 'url' => '#'],
    ], ] ) --}}

    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <div
            class="tw-flex tw-items-center md:tw-items-start {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : 'tw-justify-start' }}">
            <h1 class="tw-h1 tw-w-1/2">
                Daftar Penduduk
            </h1>

            @if (Auth::user()->hasLevel['level_kode'] == 'RT')
                <a href="{{ route('keluarga-tambah') }}"class="tw-btn tw-btn-primary tw-btn-md tw-btn-round md:tw-btn-lg">
                    Tambah Data</a>
            @endif

        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href="{{ route('penduduk.warga') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'penduduk.warga' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
                    Warga
                </a>
                <a href="{{ route('keluarga') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'keluarga' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
                    Keluarga
                </a>
                <div
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-w-full tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600">
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-3">
                {{-- Start: Tool Bar --}}
                <div class="tw-flex tw-gap-2 tw-w-full">
                    @if (Auth::user()->hasLevel['level_kode'] == 'RW')
                        <x-input.label class="tw-relative tw-w-40" for="scope_data-list">
                            <x-input.select2  name="scope_data" default="Semua"
                                placeholder="" gap="tw-top-12"></x-input.select2>
                        </x-input.label>
                        {{-- <button
                            class="tw-relative tw-h-11 tw-pr-8 tw-pl-3 tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-font-sans tw-font-bold tw-text-base tw-rounded-lg hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n100 focus:tw-border-b500 focus:tw-border-2"
                            type="button">
                            <span class="tw-placeholder">
                                Semua
                            </span>
                            <span
                                class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-2 tw-flex tw-items-center  tw-cursor-pointer">
                                <img class="tw-w-5 tw-bg-cover"
                                    src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}" alt="back">
                            </span>
                        </button> --}}
                    @endif
                    <div class="tw-relative">
                        <button id="filter"
                            class="tw-btn tw-btn-outline tw-btn-round-md tw-btn-lg tw-pl-3 tw-pr-4 tw-gap-1 tw-bg-n100"
                            type="button">
                            <span class="tw-flex tw-items-center  tw-cursor-pointer">
                                <x-icons.actionable.filter color="n1000" size="20"
                                    stroke="2"></x-icons.actionable.filter>
                            </span>
                            <span class="tw-placeholder">
                                Filter
                            </span>
                        </button>
                        <div
                            class="tw-absolute tw-top-12 tw-bg-n100 tw-filter-w-sm sm:tw-w-[280px] tw-flex tw-flex-col tw-gap-0 tw-border-[1.5px] tw-border-n400 tw-divide-n400 tw-rounded-lg tw-z-10">
                            {{-- Head --}}
                            <div class="tw-w-full tw-flex tw-items-center tw-justify-between tw-px-4 tw-py-3">
                                <h3>Filter</h3>
                                <a href="#"
                                    class="tw-text-sm tw-font-sans tw-font-medium tw-text-b500 tw-underline">Reset
                                    Filter</a>
                            </div>
                            {{-- Body --}}
                            <div class="tw-flex tw-flex-col tw-gap-3 tw-w-full tw-p-4 tw-border-t-[1.5px]">
                                {{-- Filter Group --}}
                                <div class="tw-flex tw-flex-col tw-gap-2 tw-w-full">
                                    <h3 class="tw-text-sm">Agama</h3>
                                    {{-- Items Group --}}
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-2" id="agama">
                                        <button
                                            id="Buddha"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Buddha
                                        </button>
                                        <button
                                        id="Hindu"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Hindu
                                        </button>
                                        <button
                                            id="Islam"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Islam
                                        </button>
                                        <button
                                        id="Katolik"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Katolik
                                        </button>
                                        <button
                                            id="Konghuchu"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Konghuchu
                                        </button>
                                        <button
                                        id="Kristen"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Kristen
                                        </button>
                                    </div>
                                </div>
                                {{-- Filter Group --}}
                                <div class="tw-flex tw-flex-col tw-gap-2 tw-w-full">
                                    <h3 class="tw-text-sm">Status Warga</h3>
                                    {{-- Items Group --}}
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-2" id="status_warga">
                                        <button
                                            id="Aktif"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Aktif
                                        </button>
                                        <button
                                            id="Migrasi Keluar"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Migrasi
                                        </button>
                                        <button
                                            id="Meninggal"
                                            class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
                                            Meninggal
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- Footer --}}
                            <div class="tw-w-full tw-flex tw-items-center tw-justify-end tw-px-4 tw-py-3 tw-border-t-[1.5px]">
                                <button class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md" id="apply-filter">
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tw-relative tw-flex tw-w-full tw-grid-rows-3">
                        <input type="text" placeholder="Cari"
                            class="tw-input-enabled md:tw-w-80 tw-h-11 tw-pl-8 tw-pr-3 tw-bg-n100 tw-border-[1.5px]"
                            type="button" id="searchBox">
                        </input>
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-2 tw-flex tw-items-center tw-cursor-pointer">
                            <x-icons.actionable.search color="n1000" size="20"
                                stroke="2"></x-icons.actionable.search>
                        </span>
                        </span>
                    </div>
                </div>
                {{-- End: Tool Bar --}}

                {{-- Start: Table HERE --}}
                <div class="tw-w-vw tw-overflow-x-auto">

                    <table class="tw-w-[780px] md:tw-w-full" id="dataWarga">
                        <thead>
                            <tr class="">
                                <th class="tw-w-[48px]">No</th>
                                <th class="tw-w-[240px]">NIK</th>
                                <th class="md:tw-grow tw-min-w-fit">Nama</th>
                                <th class="tw-w-[150px]">Jenis Kelamin</th>
                                <th class="tw-w-[172px]">Tanggal Lahir</th>
                                <th class="tw-w-[92px]">Agama</th>
                                <th class="tw-w-[150px]">Status Warga</th>
                                <th class="tw-h-11"></th>
                            </tr>
                        </thead>
                        <tbody class="tw-divide-y-2 tw-divide-n400">
                            {{-- @foreach ($warga as $w) --}}
                            {{-- <tr class="tw-h-16 hover:tw-bg-n300">
                                    <td></td>
                                    <td>{{ $w->NIK }}</td>
                                    <td>{{ $w->nama }}</td>
                                    <td>{{ $w->jenis_kelamin }}</td>
                                    <td>{{ $w->tanggal_lahir }}</td>
                                    <td>{{ $w->agama }}</td>
                                    <td>{{ $w->status_warga }}</td>
                                    <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                                        <a href="{{ route('wargaDetail', [$w->NIK]) }}"
                                            class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                            Detail
                                        </a>
                                    </td>
                                </tr> --}}
                            {{-- @endforeach --}}
                        </tbody>
                    </table>

                    <div>

                    </div>

                </div>
                {{-- End: Table HERE --}}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        var filter_agama = [];
        var filter_statusWarga = [];
        $(document).ready(function() {
            dataUser = $('#dataWarga').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('warga.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.scope_data = $('input[name="scope_data"]').val();
                        d.agama = filter_agama;
                        d.status_warga = filter_statusWarga;
                    }
                },
                paging: true,
                language: {
                    paginate: {
                        previous: '<',
                        next: '>',
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 hover:tw-bg-n300 tw-flex");
                },
                drawCallback: function() {
                    $('.pagination').addClass(
                        'tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg'
                    );
                    $('.paginate_button').addClass(
                        'tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300');
                    $('.paginate_button.active').addClass(
                        'tw-bg-n400');
                    $('.dataTables_filter').css('display', 'none');
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
                order: [
                    [2, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-w-[48px]",
                    orderable: false,
                    // searchable: false
                }, {
                    data: "NIK",
                    className: "tw-w-[240px]",
                    orderable: false,
                    searchable: true
                }, {
                    data: "nama",
                    className: "tw-grow",
                    orderable: true,
                    searchable: true
                }, {
                    data: "jenis_kelamin",
                    className: "tw-w-[150px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "tanggal_lahir",
                    className: "tw-w-[172px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "agama",
                    className: "tw-w-[92px]",
                    orderable: false,
                    searchable: false
                }, {
                    data: "status_warga",
                    className: "tw-w-[150px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "action",
                    className: "tw-w-[108px] tw-h-tw-h-11 tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }]
            });
            $('input[name="scope_data"]').on('change', function () {
                dataUser.ajax.reload();
            });
        });
        $('#searchBox').keyup(function() {
            dataUser.search($(this).val()).draw();
        });
        $('#apply-filter').on('click', function () {
            filter_agama = [];
            filter_statusWarga = [];
            $.each($('#agama button.tw-filter-active'), function (idx, val) {
                 filter_agama.push($(val).attr('id'))
            });
            $.each($('#status_warga button.tw-filter-active'), function (idx, val) {
                 filter_statusWarga.push($(val).attr('id'))
            });
            dataUser.ajax.reload();
        });
    </script>
@endpush
