@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css')}}">
@endpush

@section('content')
    {{-- canEdit = if RW => False, RT => False --}}
    {{-- @include('layout.tableset',['pageTitle' => 'Daftar Penduduk',  'canEdit' => true, 'topMenu' => [
        ['title' => 'Warga', 'url' => '#'],
        ['title' => 'Keluarga', 'url' => '#'],
    ], ] ) --}}

    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <div class="tw-flex tw-items-center md:tw-items-start tw-justify-start">
            <h1 class="tw-h1 tw-w-1/2">
                Daftar Pengajuan
            </h1>

        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href="{{ route('dataBaru') }}"
                    class="tw-flex tw-w-fit tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'dataBaru' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
                    Pengajuan
                </a>
                <div
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-flex-grow tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600">
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
                <div class="tw-w-vw tw-overflow-x-scroll">

                    <table class="tw-w-[780px] md:tw-w-full" id="tablePengajuan">
                        <thead>
                            <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                <th>No</th>
                                <th>Pengaju</th>
                                <th>No KK</th>
                                <th>Kepala Keluarga</th>
                                <th>Jenis</th>
                                <th class="tw-hidden md:tw-flex tw-h-11 tw-grow tw-items-center">Tanggal</th>
                                <th>Status Pengajuan</th>
                                <th class="tw-w-[108px]"></th>
                            </tr>
                        </thead>
                        <tbody class="tw-divide-y-2 tw-divide-n400">
                            {{-- @foreach ($dataBaru as $data) --}}
                                {{-- <tr class="tw-h-16 hover:tw-bg-n300">
                                    <td>1</td>
                                    <td>nama</td>
                                    <td>123123</td>
                                    <td>kepala</td>
                                    <td>tipe</td>
                                    <td class="tw-hidden md:tw-flex tw-min-h-full tw-grow tw-items-center">123123123</td>
                                    <td>
                                        @include('components.form.label', ['content' => 'Menunggu'])
                                    </td>
                                    <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                                        <a href=""
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
                {{-- <div
                    class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
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
    </div>
@endsection
@push('js')
<script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            dataUser = $('#tablePengajuan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('pengajuan.list') }}",
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
                },
                order: [[5, 'desc']],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    // className: "tw-w-[44px]",
                    orderable: false,
                    // searchable: false
                }, {
                    data: "user.nama",
                    // className: "tw-w-[60px]",
                    orderable: true,
                    searchable: true
                }, {
                    data: "no_kk",
                    // className: "tw-w-[120px]",
                    orderable: false,
                    searchable: true
                }, {
                    data: "keluarga.kepala_keluarga",
                    // className: "tw-w-[150px]",
                    orderable: false,
                    searchable: true
                }, {
                    data: "tipe",
                    // className: "tw-w-[172px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "tanggal_request",
                    // className: "tw-w-[92px]",
                    orderable: true,
                    searchable: true
                }, {
                    data: "status",
                    // className: "tw-w-[150px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "aksi",
                    // className: "tw-w-[108px] tw-h-tw-h-11 tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }]
            });
            // $('#level_id').on('change', function () {
            //     dataUser.ajax.reload();
            // });
        });
        $('#searchBox').keyup(function () {
            dataUser.search($(this).val()).draw();
        });
        </script>
@endpush