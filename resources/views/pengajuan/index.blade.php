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

    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <div class="tw-flex tw-items-center md:tw-items-start tw-justify-start">
            <h1 class="tw-h1 tw-w-1/2">
                Daftar Pengajuan
            </h1>

        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href="{{ route('pengajuan') }}"
                    class="tw-flex tw-w-fit tw-justify-center tw-items-center tw-h-8 tw-px-2 {{ Route::currentRouteName() == 'pengajuan' ? 'tw-border-b-2 tw-border-b500' : 'tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700' }} tw-top-menu-text">
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
                        <x-input.label class="tw-relative tw-w-40" for="scope_data-list">
                            <x-input.select2 name="scope_data" default="Semua" placeholder=""
                                gap="tw-top-12"></x-input.select2>
                        </x-input.label>
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
                        <x-filter.index>

                            <x-filter.head></x-filter.head>
                            {{-- Body --}}
                            <x-filter.body>
                                {{-- Filter Group --}}
                                <x-filter.items-group id="jenis" title="Jenis">
                                    <x-filter.item id="Perubahan Warga">Perubahan Warga</x-filter.item>
                                    <x-filter.item id="Perubahan Keluarga">Perubahan Keluarga</x-filter.item>
                                    <x-filter.item id="Pembaruan">Pembaruan</x-filter.item>
                                </x-filter.items-group>
                                <x-filter.items-group id="status_pengajuan" title="Status Pengajuan">
                                    <x-filter.item id="Menunggu">Menunggu</x-filter.item>
                                    <x-filter.item id="Dikonfirmasi">Dikonfirmasi</x-filter.item>
                                    <x-filter.item id="Ditolak">Ditolak</x-filter.item>
                                </x-filter.items-group>
                            </x-filter.body>
                            {{-- Footer --}}
                            <x-filter.footer>
                                <button class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md" id="apply-filter">
                                    Terapkan
                                </button>
                            </x-filter.footer>
                        </x-filter.index>
                    </div>
                    <div class="tw-relative tw-flex tw-grow md:tw-grow-0 md:tw-w-80 tw-grid-rows-3">
                        <x-input.leadicon type="text" name="searchBox" placeholder="Cari No KK, Kepala Keluarga">
                            <x-icons.actionable.search color="n1000" size="20"
                                stroke="2"></x-icons.actionable.search>
                        </x-input.leadicon>
                    </div>
                </div>
                {{-- End: Tool Bar --}}

                {{-- Start: Table HERE --}}
                <div class="tw-w-vw tw-overflow-x-auto tw-pb-3 tw-flex tw-flex-col tw-gap-3 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">

                    <table class="tw-table-fixed tw-w-fit md:tw-w-full" id="tablePengajuan">
                        <thead>
                            <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                <th>No</th>
                                <th>Pengaju</th>
                                <th>No KK</th>
                                <th>Kepala Keluarga</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Status Pengajuan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="">
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
                </div>
                {{-- End: Table HERE --}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{-- <script src="https://momentjs.com/downloads/moment.min.js"></script> --}}
    <script src="{{ asset('assets/plugins/moment/moment.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        var filter_jenis = [];
        var filter_statusPengajuan = [];

        function styling_filter_button(filter_count) {
            if ((filter_count) != 0) {
                $('button#filter').addClass('tw-border-b500');
            } else {
                $('button#filter').removeClass('tw-border-b500');
            }
        }

        function reload_filter(filterItem) {
            $.each($('button.filterItem'), function(idx, val) {
                var id = $(this).attr('id');
                var item = $(this);
                if ($(item).hasClass('tw-filter-active')) {
                    $(item).removeClass('tw-filter-active');
                    $(item).addClass('tw-filter-default');
                }
                $.each(filterItem, function(idx, val) {
                    // console.log(id + ' =? ' + val);
                    if (id == val) {
                        // console.log(id + ' == ' + val);
                        if ($(item).hasClass('tw-filter-default')) {
                            $(item).removeClass('tw-filter-default');
                        }
                        $(item).addClass('tw-filter-active');

                    }
                });
            });
        }

        $(document).ready(function() {
            dataUser = $('#tablePengajuan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('pengajuan.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.scope_data = $('input[name="scope_data"]').val();
                        d.jenis = filter_jenis;
                        d.status_pengajuan = filter_statusPengajuan;
                    }
                },
                dom: 'tp',
                lengthMenu: [25],
                paging: true,
                language: {
                    paginate: {
                        previous: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.654 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72"/></svg></span>`,
                        next: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72"/></svg></span>`,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 tw-flex");
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
                order: [[5, 'desc']],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                    searchable: false
                }, {
                    data: "user.nama",
                    className: "tw-min-w-[112px] tw-max-w-[112px]",
                    orderable: true,
                    searchable: true
                }, {
                    data: "no_kk",
                    className: "tw-min-w-[220px] tw-max-w-[220px]",
                    orderable: false,
                    searchable: true
                }, {
                    data: "keluarga.kepala_keluarga",
                    className: "tw-grow tw-shrink tw-min-w-[220px]",
                    orderable: false,
                    searchable: true
                }, {
                    data: "tipe",
                    className: "tw-min-w-[170px] tw-max-w-[170px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "tanggal_request",
                    className: "tw-min-w-[140px] tw-max-w-[140px] tw-table-right-align",
                    render: function(data, type, row){
                        if(type === "sort" || type === "type"){
                            return data;
                        }
                        return moment(data).format("YYYY-MM-DD");
                    },
                    orderable: true,
                    searchable: true
                }, {
                    data: "status",
                    className: "tw-min-w-[192px] tw-max-w-[192px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "tw-min-w-[76px] tw-max-w-[76px] tw-h-tw-h-11 tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }],
                columnDefs: [{
                    targets: [3],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' + data + '</div>';
                        }
                        return data;
                    }
                }]
            });
            $('input[name="scope_data"]').on('change', function() {
                dataUser.ajax.reload();
            });
        });
        $('#searchBox').keyup(function () {
            dataUser.search($(this).val()).draw();
        });

        $('button#reset-filter').on('click', function () {
            filter_jenis = [];
            filter_statusPengajuan = [];
            var filterItem = filter_jenis.concat(filter_statusPengajuan);
            reload_filter(filterItem);
            dataUser.ajax.reload();
        });

        $('button#filter').click(function() {
            var filterItem = filter_jenis.concat(filter_statusPengajuan);
            reload_filter(filterItem);
            styling_filter_button(filter_jenis.length + filter_statusPengajuan);

        });
        $('#apply-filter').on('click', function() {
            // console.log('apply flter');
            filter_jenis = [];
            filter_statusPengajuan = [];
            $.each($('#jenis button.tw-filter-active'), function(idx, val) {
                filter_jenis.push($(val).attr('id'))
            });
            $.each($('#status_pengajuan button.tw-filter-active'), function(idx, val) {
                filter_statusPengajuan.push($(val).attr('id'))
            });
            dataUser.ajax.reload();
            $('.filterArea').addClass('tw-hidden');
            // console.log();
            // console.log((filter_jenis.length + filter_statusPengajuan));
            styling_filter_button(filter_jenis.length + filter_statusPengajuan);
        });

        </script>
@endpush