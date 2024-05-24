@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Admin /
            <span class="tw-font-bold tw-text-b500">Detail Admin</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : '' }}  tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Admin</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Admin</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Nama',
                                'content' => ''
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Username',
                                'content' => ''
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Keterangan',
                                'content' => ''
                            ])
                
                        </div>
                    </div>
                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-auto">
                        <h2 class="">Daftar Publikasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <table class="tw-w-[702px] md:tw-w-full" id="daftarWarga">
                                <thead class="">
                                    <tr class="">
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th class="tw-w-[108px]"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($keluarga->warga as $warga)
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$warga->NIK}}</td>
                                            <td>{{$warga->nama}}</td>
                                            <td>{{$warga->status_keluarga}}</td>
                                            <td
                                                class="tw-w-[140px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                                <a href="{{route('wargaDetail', $warga->NIK)}}"
                                                    class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>


                <div class="tw-flex">
                    <a href="{{ route('keluarga') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
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
        <script>alert('{{Session::get('message')[1]}}')</script>
    @endif
@endsection


@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            dataWarga = $('#daftarWarga').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "",
                    "dataType": "json",
                    "type": "POST",
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 hover:tw-bg-n300 tw-flex");
                },
                drawCallback: function() {
                    $('.table.dataTable').css('border-collapse', 'collapse');
                },
                paging: false,
                info: false,
                searching: false,
                order: [
                    [2, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-w-[44px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "judul",
                    className: "tw-w-[180px]",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kategori",
                    className: "tw-grow",
                    orderable: true,
                    searchable: false
                }, {
                    data: "status",
                    className: "tw-w-[180px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "action",
                    className: "tw-w-[98px] tw-h-tw-h-11 tw-flex tw-items-center tw-justify-center",
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
@endpush
