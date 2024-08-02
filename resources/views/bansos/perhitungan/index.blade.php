@extends('layout.layout', ['isForm' => false])

@section('content')
    <div
        class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <div class="tw-flex tw-items-center md:tw-items-start tw-justify-between">
            <h1 class="tw-h1 tw-w-1/2">
                Penerimaan Bansos
            </h1>

            @if ($isKeluargaExist)
                <a
                    href="{{ route('bansos.perhitungan.detailPerhitungan') }}"class="tw-btn tw-btn-primary tw-btn-md md:tw-btn-lg tw-btn-round">Detail
                    Perhitungan</a>
            @else
                <button disabled
                    href="{{ route('bansos.perhitungan.detailPerhitungan') }}"class="tw-btn tw-btn-disabled tw-btn-md md:tw-btn-lg tw-btn-round">Detail
                    Perhitungan</button>
            @endif
        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href="{{ route('bansos.kriteria') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700">
                    Kriteria
                </a>
                <a href=""
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 tw-border-b-[2px] tw-border-b500 tw-top-menu-text">
                    Perhitungan
                </a>
                <div
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-w-full tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600">
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-3">
                {{-- Start: Tool Bar --}}
                <div class="tw-flex tw-gap-2 tw-w-full">

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
                <div
                    class="tw-w-vw tw-overflow-x-auto tw-pb-3 tw-flex tw-flex-col tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">

                    <table class="tw-table-fixed tw-min-w-fit tw-w-full" id="dataBansos">
                        <thead>
                            <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                <th>No</th>
                                <th>Kepala Keluarga</th>
                                <th>Tagihan Listrik</th>
                                <th>Luas Bangunan</th>
                                <th>Total Penghasilan</th>
                                <th>Jumlah Bekerja</th>
                                <th>Tanggungan</th>
                                <th>Jumlah Bersekolah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class=" ">

                            {{-- DATA HERE --}}

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
    @if (session()->has('flash'))
        <script>
            alert('{{ session()->get('flash')->message }}');
        </script>
    @endif
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            dataBansos = $('#dataBansos').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('perhitungan.gdss') }}",
                    "dataType": "json",
                    "type": "POST",
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
                    $(row).addClass("tw-h-16 tw-w-full tw-flex");
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
                    [0, 'asc']
                ],
                columns: [{
                    data: "rank", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-[60px] tw-max-w-[60px]",
                    orderable: true,
                    // searchable: false
                }, {
                    data: "kepala_keluarga",
                    className: "tw-min-w-[220px] tw-grow tw-shrink",
                    orderable: false,
                    searchable: true
                }, {
                    data: "tagihan_listrik",
                    className: "tw-min-w-[166px] tw-max-w-[166px] tw-table-right-align",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var formattedValue = parseFloat(data).toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        });
                        formattedValue = formattedValue.replace(/,00$/, '');
                        return formattedValue;
                    }
                }, {
                    data: "luas_bangunan",
                    className: "tw-min-w-[170px] tw-max-w-[170px] tw-table-right-align",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var formattedValue = data + " m²";
                        return formattedValue;
                    }
                }, {
                    data: "total_penghasilan",
                    className: "tw-min-w-[200px] tw-max-w-[200px] tw-currency tw-table-right-align",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var formattedValue = parseFloat(data).toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        });
                        formattedValue = formattedValue.replace(/,00$/, '');
                        return formattedValue;
                    }
                }, {
                    data: "jumlah_warga_berpenghasilan",
                    className: "tw-min-w-[168px] tw-max-w-[168px] tw-table-right-align",
                    orderable: false,
                    searchable: false
                }, {
                    data: "tanggungan",
                    className: "tw-min-w-[150px] tw-max-w-[150px] tw-table-right-align",
                    orderable: false,
                    searchable: false
                }, {
                    data: "jumlah_warga_bersekolah",
                    className: "tw-min-w-[206px] tw-max-w-[206px] tw-table-right-align",
                    orderable: false,
                    searchable: false
                }, {
                    data: "action",
                    className: "tw-min-w-[100px] tw-max-w-[100px] tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }],
                columnDefs: [{
                    targets: [2],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });
            // $('#level_id').on('change', function () {
            //     dataBansos.ajax.reload();
            // });
        });
        $('#searchBox').keyup(function() {
            dataBansos.search($(this).val()).draw();
        });

        function formatCurrency() {
            $('.tw-currency').each(function() {
                var value = $(this).text();
                var parts = value.toString().split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                $(this).text(parts.join(','));
            });
        }

        dataBansos.on('draw', function() {
            formatCurrency();
        });
    </script>
@endpush
