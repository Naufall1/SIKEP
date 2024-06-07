@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @php
        // dd($admin);
    @endphp
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10  tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <p class="tw-breadcrumb tw-text-n500">Daftar Admin /
            <span class="tw-font-bold tw-text-b500">Detail Admin</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Admin</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">
                        <h2 class="">Admin</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Nama',
                                'content' => $admin->nama
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Username',
                                'content' => $admin->username
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Keterangan',
                                'content' => $admin->keterangan
                            ])

                        </div>
                    </div>
                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidde tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[400ms]">
                        <h2 class="">Daftar Publikasi</h2>
                        <div class="tw-overflow-x-auto tw-w-full tw-flex tw-flex-col tw-gap-3">

                            <table class="tw-table-fixed tw-w-[701px]" id="daftarPublikasi">
                                <thead class="">
                                    <tr class="">
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th></th>
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


                <div class="tw-flex tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[600ms]">
                    <a href="{{ route('admin') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
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
            alert('{{Session::get('message')[1]}}');
        </script>
    @endif
@endsection


@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            dataPublikasi = $('#daftarPublikasi').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{route('admin.publikasi.list')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.user_id = {{$admin->user_id}}
                     }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 tw-w-full tw-flex");
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
                    data: "kode", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                    searchable: false
                }, {
                    data: "judul",
                    className: "tw-min-w-[220px] tw-grow tw-shrink",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kategori",
                    className: "tw-min-w-[108px] tw-max-w-[108px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "status",
                    className: "tw-min-w-[122px] tw-max-w-[122px]",
                    orderable: true,
                    searchable: false
                }, {
                    data: "action",
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
