@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <div
            class="tw-flex tw-items-center md:tw-items-start {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : 'tw-justify-start' }}">
            <h1 class="tw-h1 tw-w-1/2">
                Daftar Penduduk
            </h1>

            @if (Auth::user()->hasLevel['level_kode'] == 'RT')
                <a href="{{ route('keluarga-tambah') }}"class="tw-btn tw-btn-primary tw-btn-md md:tw-btn-lg tw-btn-round">
                    Tambah Data</a>
            @endif

        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href="{{ route('warga') }}"
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
                },
                order: [
                    [1, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-w-[48px]",
                    orderable: false,
                    // searchable: false
                }, {
                    data: "no_kk",
                    className: "tw-w-[250px]",
                    orderable: true,
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
