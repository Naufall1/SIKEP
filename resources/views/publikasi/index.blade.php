@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <div class="tw-flex tw-items-center md:tw-items-start tw-justify-between">
            <h1 class="tw-h1 tw-w-1/2">
                Daftar Publikasi
            </h1>

            <a href=""class="tw-btn tw-btn-primary tw-btn-md md:tw-btn-lg tw-btn-round">
                Tambah Data</a>

        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href="{{ route('penduduk.warga') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'warga' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
                    Warga
                </a>
                <a href="{{ route('keluarga') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'keluarga' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
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
                        <button
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
                        </button>
                    @endif
                    <button
                        class="tw-relative tw-h-11 tw-pl-8 tw-pr-3 tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-font-sans tw-font-bold tw-text-base tw-rounded-lg hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n100 focus:tw-border-b500 focus:tw-border-2"
                        type="button">
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-2 tw-flex tw-items-center  tw-cursor-pointer">
                            <img class="tw-w-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/filter.svg') }}"
                                alt="back">
                        </span>
                        <span class="tw-placeholder">
                            Filter
                        </span>
                    </button>
                    <div class="tw-relative tw-flex tw-w-full tw-grid-rows-3">
                        <input type="text" placeholder="Cari"
                            class="tw-input-enabled md:tw-w-80 tw-h-11 tw-pl-8 tw-pr-3 tw-bg-n100 tw-border-[1.5px]"
                            type="button" id="searchBox">
                        </input>
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-2 tw-flex tw-items-center tw-cursor-pointer">
                            <img class="tw-w-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/search.svg') }}"
                                alt="back">
                        </span>
                    </div>
                </div>
                {{-- End: Tool Bar --}}

                {{-- Start: Table HERE --}}
                <div class="tw-w-vw tw-overflow-x-auto">

                    <table class="tw-w-[780px] md:tw-w-full" id="dataKeluarga" style="">
                        <thead>
                            <tr class="">
                                <th class="tw-w-[48px]">No</th>
                                <th class="tw-w-[250px]">No KK</th>
                                <th class="tw-w-[280px]">Kepala Keluarga</th>
                                <th class="tw-w-[300px] md:tw-grow">Alamat</th>
                                <th class="tw-w-[60px]">RT</th>
                                <th class="tw-w-[108px]"></th>
                            </tr>
                        </thead>
                        <tbody class="tw-divide-y-2 tw-divide-n400">
                            {{-- @foreach ($keluarga as $k)
                                <tr class="tw-h-16 hover:tw-bg-n300">
                                    <td></td>
                                    <td>{{ $k->no_kk }}</td>
                                    <td>{{ $k->kepala_keluarga }}</td>
                                    <td>{{ $k->alamat }}</td>
                                    <td>{{ $k->RT }}</td>
                                    <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                                        <a href="{{ route('keluargaDetail', $k->no_kk) }}"
                                            class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                    <div>

                    </div>

                </div>
                {{-- End: Table HERE --}}
            </div>

            {{-- <div class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    <img class="tw-h-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/arrow-left-1.svg') }}"
                        alt="<">
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300 tw-bg-n400"
                    href="">
                    1
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    2
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    ...
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    <img class="tw-h-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/arrow-right-1.svg') }}"
                        alt="<">
                </a>
            </div> --}}

        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            dataKeluarga = $('#dataKeluarga').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('keluarga.list') }}",
                    "dataType": "json",
                    "type": "POST",
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
                    data: "no_kk",
                    className: "tw-w-[250px]",
                    orderable: false,
                    searchable: true
                }, {
                    data: "kepala_keluarga",
                    className: "tw-w-[280px]",
                    orderable: true,
                    searchable: true
                }, {
                    data: "alamat",
                    className: "tw-w-[300px] md:tw-grow",
                    orderable: false,
                    searchable: true
                }, {
                    data: "RT",
                    className: "tw-w-[60px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "action",
                    className: "tw-w-[108px]",
                    orderable: false,
                    searchable: false
                }]
            });
            // $('#level_id').on('change', function () {
            //     dataKeluarga.ajax.reload();
            // });
        });
        $('#searchBox').keyup(function() {
            dataKeluarga.search($(this).val()).draw();
        });
    </script>
@endpush
