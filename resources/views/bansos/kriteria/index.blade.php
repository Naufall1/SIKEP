@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <div class="tw-flex tw-h-11 tw-items-center md:tw-items-start tw-justify-between">
            <h1 class="tw-h1 tw-w-1/2">
                Penerimaan Bansos
            </h1>

            {{-- <a href=""class="tw-h-10 tw-px-4 md:tw-h-11 md:tw-px-6 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center"> Tambah Data</a>     --}}
        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href=""
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 tw-border-b-[2px] tw-border-b500 tw-top-menu-text">
                    Kriteria
                </a>
                <a href="{{ route('bansos.perhitungan') }}"
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700">
                    Perhitungan
                </a>
                <div
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-w-full tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600">
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-3">
                {{-- Start: Tool Bar --}}
                <div class="tw-flex tw-gap-2 tw-w-full">
                    <div class="tw-relative tw-flex tw-grow md:tw-grow-0 md:tw-w-80 tw-grid-rows-3">
                        <x-input.leadicon type="text" name="searchBox" placeholder="Cari Kepala Keluarga">
                            <x-icons.actionable.search color="n1000" size="20"
                                stroke="2"></x-icons.actionable.search>
                        </x-input.leadicon>
                    </div>
                </div>
                {{-- End: Tool Bar --}}

                {{-- Start: Table HERE --}}
                <div class="tw-w-vw tw-overflow-x-scroll">

                    <table class="tw-min-w-[1400px] md:tw-w-full" id="dataBansos">
                        <thead>
                            <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                <th>No</th>
                                <th>Kepala Keluarga</th>
                                <th>Tagihan Listrik</th>
                                <th>Luas Bangunan</th>
                                <th>Total Penghasilan Keluarga</th>
                                <th>Jumlah Warga dengan Penghasilan</th>
                                <th>Tanggungan</th>
                                <th>Jumlah Bersekolah</th>
                                <th class="tw-w-[108px]"></th>
                            </tr>
                        </thead>
                        <tbody class="tw-divide-y-2 tw-divide-n400">

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
        <script>alert('{{ session()->get("flash")->message }}');</script>
    @endif
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            dataBansos = $('#dataBansos').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('bansos.list') }}",
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
                order: [[2, 'asc']],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-w-[48px]",
                    orderable: false,
                    // searchable: false
                }, {
                    data: "kepala_keluarga",
                    className: "tw-w-[240px]",
                    orderable: true,
                    searchable: true
                }, {
                    data: "tagihan_listrik",
                    className: "tw-grow",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        var formattedValue = parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        formattedValue = formattedValue.replace(/,00$/, '');
                        return formattedValue;
                    }
                }, {
                    data: "luas_bangunan",
                    className: "tw-w-[150px]",
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                    var formattedValue = data + " m²";
                    return formattedValue;
                }
                }, {
                    data: "total_penghasilan",
                    className: "tw-w-[172px] tw-currency",
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        var formattedValue = parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        formattedValue = formattedValue.replace(/,00$/, '');
                        return formattedValue;
                    }
                }, {
                    data: "jumlah_warga_berpenghasilan",
                    className: "tw-w-[92px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "tanggungan",
                    className: "tw-w-[150px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "jumlah_warga_bersekolah",
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
            // $('#level_id').on('change', function () {
            //     dataBansos.ajax.reload();
            // });
        });
        $('#searchBox').keyup(function () {
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

            dataBansos.on('draw', function () {
                formatCurrency();
            });
        </script>
@endpush
