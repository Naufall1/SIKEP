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
        <div class="tw-flex tw-items-center md:tw-items-start">
            <h1 class="tw-h1 tw-w-1/2 tw-flex-grow">
                Daftar Admin
            </h1>

        </div>

        <div class="tw-flex tw-flex-col tw-gap-4">
             {{-- <div class="tw-flex">
                <a href="{{ route('penduduk.warga') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'penduduk.warga' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
                    Warga
                </a>
                <a href="{{ route('keluarga') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'keluarga' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
                    Keluarga
                </a> --}}
                <div
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-w-full tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600">
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-3">
                {{-- Start: Tool Bar --}}
                <div class="tw-flex tw-gap-2 tw-w-full tw-justify-between">
                    <div class="tw-relative tw-flex tw-grow md:tw-grow-0 md:tw-w-80 tw-grid-rows-3">
                        <x-input.leadicon type="text" name="searchBox" placeholder="Cari">
                            <x-icons.actionable.search color="n1000" size="20"
                                stroke="2"></x-icons.actionable.search>
                        </x-input.leadicon>
                    </div>
                    <a href="{{route('admin.create')}}" class="tw-btn tw-btn-primary tw-btn-md tw-btn-round md:tw-btn-lg">
                        Tambah Data
                    </a>
                </div>
                {{-- End: Tool Bar --}}

                {{-- Start: Table HERE --}}
                <div class="tw-w-vw tw-overflow-x-auto">

                    <table class="tw-w-[780px] md:tw-w-full" id="dataWarga">
                        <thead>
                            <tr class="">
                                <th class="tw-w-[48px]">No</th>
                                <th class="md:tw-grow tw-min-w-fit">Nama</th>
                                <th class="tw-w-[150px]">Username</th>
                                <th class="tw-w-[172px]">Keterangan</th>
                                <th class="tw-h-11"></th>

                            </tr>
                        </thead>
                        <tbody class="tw-divide-y-2 tw-divide-n400">
                            {{-- DATA HERE --}}
                        </tbody>
                    </table>

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
        $(document).ready(function() {
            dataAdmin = $('#dataWarga').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('admin.list') }}",
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
                // order: [
                //     [2, 'asc']
                // ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-w-[48px]",
                    orderable: true,
                },
                {
                    data: "nama",
                    className: "tw-grow",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "username",
                    className: "tw-w-[150px]",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "keterangan",
                    className: "tw-w-[172px]",
                    orderable: false,
                    searchable: true
                },
                {
                    data: "action",
                    className: "tw-w-[108px] tw-h-tw-h-11 tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }
            ]
            });
        });
        $('#searchBox').keyup(function() {
            dataAdmin.search($(this).val()).draw();
        });
    </script>
@endpush
