@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    {{-- {{dd(!empty($errors->messages()))}} --}}
    <div id="modalAddBansos"
        class="{{ !empty($errors->messages()) ? '' : 'tw-hidden' }} modal-menu tw-z-50 tw-animate-disolve tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
        <div
            class="tw-w-96 md:tw-w-96 tw-relative tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] ">
            <div class="tw-flex tw-items-center tw-px-4 tw-h-14 tw-border-b-[1px]">
                <h2>Tambah Bansos</h2>
            </div>
            <div id="navMenus" class="tw-flex tw-gap-4 tw-w-full tw-flex-col tw-p-4">
                <form class="tw-flex tw-flex-col tw-gap-7 tw-items-end"
                    action="{{ route('bansos.perhitungan.detail.tambahBansos', $dataKeluarga->no_kk) }}" method="POST"
                    id="formData" enctype="multipart/form-data">
                    @csrf
                    <div class="tw-flex tw-flex-col tw-gap-3 tw-w-full">
                        <x-input.label required class="tw-relative" for="jenis_bansos-list" label="Jenis Bansos">
                            <x-input.select2 name="jenis_bansos" default="{{old('jenis_bansos', 'Pilih Jenis Bansos') ?? 'Pilih Jenis Bansos'}}"
                                placeholder="Pilih Jenis Bansos"></x-input.select2>
                            @error('jenis_bansos')
                                <x-input.error-message>{{ $message }}</x-input.error-message>
                            @enderror
                        </x-input.label>

                        <x-input.label required for="tanggal_menerima" label="Tanggal Penerimaan">
                            <x-input.input placeholder="" type="date" id="tanggal_menerima"
                                name="tanggal_menerima" value="{{old('tanggal_menerima')}}"></x-input.input>
                            @error('tanggal_menerima')
                            <x-input.error-message>{{ $message }}</x-input.error-message>
                            @enderror
                        </x-input.label>

                        {{-- <x-input.label for="keterangan" label="Keterangan">
                            <x-input.textarea class="tw-h-32" name="keterangan" placeholder="Catatan"></x-input.textarea>
                        </x-input.label> --}}


                    </div>

                    <div class="tw-flex tw-gap-2">
                        <button href="" class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                            id="closeModal">Batal</button>
                        <button class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Tambah</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div
        class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10  tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <p class="tw-breadcrumb tw-text-n500">Perhitungan /
            <span class="tw-font-bold tw-text-b500">Data Alternatif</span>
        </p>

        <div class="md:tw-w-full">

            <div class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Alternatif</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div
                        class="tw-flex tw-flex-col tw-gap-2 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">
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

                    <div
                        class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[400ms]">
                        <h2 class="">Data Kriteria</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Tagihan Listrik',
                                'content' => 'Rp ' . number_format($dataKriteria->tagihan_listrik, 0, ',', '.'),
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Luas Bangunan',
                                'content' => $dataKriteria->luas_bangunan . ' m²',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Total Penghasilan',
                                'content' => 'Rp ' . number_format($dataKriteria->total_penghasilan, 0, ',', '.'),
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
                    </div>
                    <div
                        class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[600ms]">
                        <h2 class="">Daftar Bansos</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <div class="tw-w-full tw-overflow-hidden tw-overflow-x-auto">


                                <table class="tw-w-[701px]" id="daftarBansos">
                                    {{-- <button id="buttonAddBansos"
                                    class="tw-h-10 tw-w-fit tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                    Tambah
                                </button> --}}
                                    <thead class="">
                                        <tr class="">
                                            <th>No</th>
                                            <th>Nama Bansos</th>
                                            <th>Tanggal Menerima</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


                <div
                    class="tw-flex tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[800ms]">
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
@endsection

@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var buttonRow =
                `<tr class="tw-h-16"><td class="tw-h-16 tw-flex tw-items-center tw-justify-center"><button id="buttonAddBansos" class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">Tambah</button></td></tr>`
            // dataWarga.row.add($(buttonRow)[0]).draw();
            $('table tbody').after($(buttonRow));

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
                    $(row).addClass("tw-h-16 tw-flex");
                },
                drawCallback: function() {
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<p>Tidak Ada Data</p>`);
                    $('.dataTables_empty').addClass('tw-h-4');
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
                }],
                columnDefs: [{
                    targets: [3],
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


{{-- Kalau ini fixed, uncomment select2 diatas!! --}}
@push('js')
    <script>
        function getJenisBansos() {
            let dataBansos = [];
            @foreach ($daftarBansos as $bansos)
                dataBansos.push(
                    '{{ $bansos->bansos_kode }}',
                )
            @endforeach

            return dataBansos;
        }
    </script>
@endpush
