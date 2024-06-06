@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div id="modalReject"
        class="tw-hidden tw-animate-fade tw-animate-duration-300 tw-animate-ease-in-out modal-menu tw-z-50 tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
        <div
            class="tw-w-96 md:tw-w-96 tw-relative tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] ">
            <div class="tw-flex tw-items-center tw-px-4 tw-h-14 tw-border-b-[1px]">
                <h2>Tolak Pengajuan</h2>
            </div>
            <div id="navMenus" class="tw-flex tw-gap-4 tw-w-full tw-flex-col tw-p-4">
                <form class="tw-flex tw-flex-col tw-gap-7 tw-items-end" action="{{route('pengajuan.reject.pembaharuan')}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="tw-flex tw-flex-col tw-gap-3 tw-w-full">
                        <input type="hidden" name="id" value="{{$pengajuan->id}}">

                        <x-input.label for="catatan" label="Catatan">
                            <x-input.textarea class="tw-h-32" name="catatan" placeholder="Catatan"></x-input.textarea>
                        </x-input.label>

                    </div>

                    <div class="tw-flex tw-gap-2">
                        <button class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                            id="closeModal">Batal</button>
                        <button class="tw-btn tw-btn-danger tw-btn-lg tw-btn-round" type="submit">Tolak</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10  tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        @if (session()->has('flash'))
            <x-flash-message.information message="{{session()->get('flash')->message}}"></x-flash-message.information>
        @else
        @endif {{-- DONT DELETE THIS LINE --}}
        <p class="tw-breadcrumb tw-text-n500">Daftar Data Baru /
            <span class="tw-font-bold tw-text-b500">Detail Pengajuan</span>
        </p>

        <div class="md:tw-w-full">

            <div class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Pengajuan</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Informasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            @include('components.form.textdetail', [
                                'title' => 'Jenis',
                                'content' => $pengajuan->tipe,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Pengajuan',
                                'content' => $pengajuan->status_request,
                                'isLabel' => true,
                            ])
                            @if ($pengajuan->status_request === 'Ditolak')
                                @include('components.form.textdetail', [
                                    'title' => 'Catatan',
                                    'content' => $pengajuan->catatan,
                                ])
                            @endif
                        </div>
                    </div>

                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2">
                        <h2 class="">Detail Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'No KK',
                                'content' => $pengajuan->keluarga->no_kk,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kepala Keluarga',
                                'content' => $pengajuan->keluarga->kepala_keluarga,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Alamat',
                                'content' => $pengajuan->keluarga->alamat,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kode POS',
                                'content' => $pengajuan->keluarga->kode_pos,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'RT',
                                'content' => $pengajuan->keluarga->RT,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'RW',
                                'content' => $pengajuan->keluarga->RW,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kelurahan',
                                'content' => $pengajuan->keluarga->kelurahan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kecamatan',
                                'content' => $pengajuan->keluarga->kecamatan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kota',
                                'content' => $pengajuan->keluarga->kota,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Provinsi',
                                'content' => $pengajuan->keluarga->provinsi,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kartu Keluarga',
                                'isImage' => true,
                                'content' => !isset($pengajuan->keluarga->image_kk)
                                    ? ''
                                    : asset(Storage::disk('public')->url('KK/' . $pengajuan->keluarga->image_kk)),
                            ]) {{-- kalau label kasih value var $isLabel with true --}}


                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Tagihan Listrik',
                                'content' => 'Rp ' . number_format($pengajuan->keluarga->tagihan_listrik, 0, ",", "."),

                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Luas Bangunan',
                                'content' => $pengajuan->keluarga->luas_bangunan . ' m²',
                            ])

                        </div>
                    </div>

                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden">
                        <h2 class="">Warga</h2>
                        <div class="tw-flex tw-flex-col tw-w-full tw-gap-3 tw-overflow-x-auto">

                            <table class=" tw-table-fixed tw-w-[701px]" id="tableWarga">
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
                                    {{-- <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="tw-w-[100px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                            <a href=""
                                                class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                                Detail
                                            </a>
                                        </td>
                                    </tr> --}}

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

                {{-- level_id 1 == RW --}}
                <div class="tw-flex tw-justify-between">
                    <a href="{{route('pengajuan')}}" class="tw-btn tw-btn-outline tw-btn-lg-ilead tw-btn-round"
                        type="button">
                        <x-icons.actionable.arrow-left class="tw-btn-i-lead-lg" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    @if ($user == 1 && $pengajuan->status_request == 'Menunggu')
                        <div class="tw-flex tw-gap-2">
                            <button href="" class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                                id="buttonReject">Tolak</button>
                            {{-- <a href="" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Konfirmasi</a> --}}
                            <form class="d-inline-block" method="POST"
                                action="{{ route('pengajuan.confirm.pembaharuan') }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="id" value="{{ $pengajuan->id }}">
                                <button type="submit" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round"
                                    onclick="return confirm('Apakah Anda yakin melakukan konfirmasi data ini?');">Konfirmasi</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    @php
        if (session()->has('error')) {
            echo '<h1>' . session()->get('error') . '</h1>';
        }
    @endphp
@endsection

@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#buttonReject").click(function() {
                $("#modalReject").removeClass("tw-hidden");
                $('html, body').css({
                    overflow: 'hidden',
                });
            });

            $("#modalReject #closeModal").click(function() {
                $("#modalReject").addClass("tw-hidden");
                $('html, body').css({
                    overflow: 'auto',
                });
            });

            daftarWarga = $('#tableWarga').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('pengajuan.pembaharuan.listWarga', ['id' => $pengajuan->id]) }}",
                    "dataType": "json",
                    "type": "POST",
                },
                paging: false,
                info: false,
                searching: false,
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
                    data: "aksi",
                    className: "tw-min-w-[76px] tw-max-w-[76px] tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }],
                columnDefs: [{
                    targets: [1,2],
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
