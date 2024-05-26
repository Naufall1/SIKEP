@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div id="modalAddBansos"
        class="tw-hidden modal-menu tw-z-50 tw-animate-disolve tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
        <div
            class="tw-w-96 md:tw-w-96 tw-relative tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] ">
            <div class="tw-flex tw-items-center tw-px-4 tw-h-14 tw-border-b-[1px]">
                <h2>Tambah Bansos</h2>
            </div>
            <div id="navMenus" class="tw-flex tw-gap-4 tw-w-full tw-flex-col tw-p-4">
                <form class="tw-flex tw-flex-col tw-gap-7 tw-items-end" action="{{ route('tambahPenerimaBansos') }}"
                    method="POST" id="formData" enctype="multipart/form-data">
                    <div class="tw-flex tw-flex-col tw-gap-3 tw-w-full">

                        <x-input.label class="tw-relative" for="jenis_bansos-list" label="Jenis Bansos">
                            <x-input.select2 name="jenis_bansos" placeholder="Pilih Jenis Bansos"></x-input.select2>
                        </x-input.label>

                        <x-input.label for="tanggal_penerimaan" label="Tanggal Penerimaan">
                            <x-input.input placeholder=""
                                type="date" id="tanggal_penerimaan" name="tanggal_penerimaan"></x-input.input>
                        </x-input.label>

                        <x-input.label for="keterangan" label="Keterangan">
                            <x-input.textarea class="tw-h-32" name="keterangan" placeholder="Catatan"></x-input.textarea>
                        </x-input.label>


                    </div>

                    <div class="tw-flex tw-gap-2">
                        <button href="" class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                            id="closeModal">Batal</button>
                        <a href="" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Tolak</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Kriteria /
            <span class="tw-font-bold tw-text-b500">Data Kriteria</span>
        </p>

        <div class="md:tw-w-full">

            <div class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Kriteria</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Data Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'No KK',
                                'content' => $dataKeluarga->no_kk,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kepala Keluarga',
                                'content' => $dataKeluarga->kepala_keluarga,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Alamat',
                                'content' => $dataKeluarga->alamat,
                            ])
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Data Kriteria</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Tagihan Listrik',
                                'content' => 'Rp.' . number_format($dataKriteria->tagihan_listrik, 0, ",", "."),
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Luas Bangunan',
                                'content' => $dataKriteria->luas_bangunan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Total Penghasilan',
                                'content' => 'Rp. ' . number_format( $dataKriteria->total_penghasilan, 0, ",", "."),
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Jumlah Bekerja',
                                'content' => $dataKriteria->jumlah_bekerja,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Jumlah Tanggungan',
                                'content' => $dataKriteria->jumlah_tanggungan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Jumlah Bersekolah',
                                'content' => $dataKriteria->jumlah_bersekolah,
                            ])

                        </div>
                        <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-auto">
                            <h2 class="">Daftar Bansos</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">


                                <table class="tw-w-[702px] md:tw-w-full" id="daftarBansos">
                                    <button id="buttonAddBansos"
                                                    class="tw-h-10 tw-w-fit tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Tambah
                                                </button>
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
                                        <tr class="tw-h-16 tw-border-b-[1.5px] tw-border-n400 hover:tw-bg-n300">
                                            <td class="tw-h-16 tw-relative" colspan="5">
                                                <button id="buttonAddBansos"
                                                    class=" tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-1/2 tw-translate-x-1/2  tw-h-10 tw-w-fit tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Tambah
                                                </button>
                                                {{-- <button type="submit" name="action" value="tambah"
                                                    class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-1/2 tw-translate-x-1/2  tw-h-10 tw-w-fit tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Tambah</button> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="tw-flex">
                    <a href="{{ route('bansos.perhitungan') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
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
        function getJenisBansos() {
            // let arrayWarga = [];
            // let dataWarga = [];
            // for (let i = 0; i < arrayWarga.length; i++) {
            //     dataWarga[i] = arrayWarga[i].nik + ' - ' + arrayWarga[i].nama;
            // }
            // return dataWarga;
            return [];
        }
        $(document).ready(function() {
            $("#buttonAddBansos").click(function() {
                $("#modalAddBansos").removeClass("tw-hidden");
                $('html, body').css({
                    overflow: 'hidden',
                });
            });
            $("button#closeModal").click(function() {
                $("#modalAddBansos").addClass("tw-hidden");
                $('html, body').css({
                    overflow: 'auto',
                });
            });
            dataBansos = $('#daftarBansos').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('penduduk.keluarga.detail.listBansos', ['no_kk' => $dataKeluarga->no_kk]) }}",
                    "dataType": "json",
                    "type": "POST",
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 hover:tw-bg-n300 tw-flex");
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
                    [1, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-w-[44px]",
                    orderable: false,
                    searchable: false
                }, {
                    data: "bansos_nama",
                    className: "tw-grow",
                    orderable: true,
                    searchable: false
                }, {
                    data: "tanggal_menerima",
                    className: "tw-w-[196px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "keterangan",
                    className: "tw-w-[140px]",
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
@endpush
