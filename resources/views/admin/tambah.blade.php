@extends('layout.layout', ['isForm' => true])

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Admin /
            <span class="tw-font-bold tw-text-b500">Tambah Admin</span>
        </p>

        <div class="">

            <h1 class="tw-h1 tw-mb-3">Tambah Admin</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('keluarga-tambah') }}" method="POST"
                enctype="multipart/form-data" id="formdata">
                @csrf

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="md:tw-w-80 tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Profil</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label class="tw-relative" for="nama" label="Nama">
                                <x-input.input maxlength=16 type="text" name="nama" placeholder="Masukkan Nama"
                                    value=""></x-input.input>
                                {{-- <x-input.select class="tw-hidden" name="no_kk" id="no_kk-list">
                                    <option value="no" disabled selected>Pilih KK</option>
                                    @foreach ($daftarKeluarga as $keluarga)
                                        <option value="{{ $keluarga->no_kk }}" @selected(old('no_kk', isset($formState['no_kk']) ? $formState['no_kk'] : '') == $keluarga->no_kk)>
                                            {{ $keluarga->no_kk . ' - ' . $keluarga->kepala_keluarga }}</option>
                                    @endforeach
                                </x-input.select> --}}
                            </x-input.label>

                            <x-input.label for="keterangan" label="Keterangan">
                                <x-input.input disabled type="text" name="keterangan" placeholder="Admin01"
                                    value=""></x-input.input>
                            </x-input.label>

                        </div>

                    </div>

                    <div class=" tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Akun</h2>
                        <div class="md:tw-w-80 tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="nama_pengguna" label="Nama Pengguna">
                                <x-input.input type="text" name="nama_pengguna" placeholder="Masukkan Nama Pengguna"
                                    value=""></x-input.input>
                            </x-input.label>

                            <x-input.label for="kata_sandi" label="Kata Sandi">
                                <x-input.input type="text" name="kata_sandi" placeholder="Masukkan Kata Sandi"
                                    value=""></x-input.input>
                            </x-input.label>

                            <x-input.label for="ulang_kata_sandi" label="Ulangi Kata Sandi">
                                <x-input.input type="text" name="ulang_kata_sandi" placeholder="Masukkan Kata Sandi"
                                    value=""></x-input.input>
                            </x-input.label>
                        </div>
                    </div>
                </div>
                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('penduduk.keluarga.tambah.back') }}"
                        class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline" type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#formdata').submit(function(e) {
            // e.preventDefault();
            $('#RW').prop('disabled', false);
            $('#RT').prop('disabled', false);
            $('#kode_pos').prop('disabled', false);
            $('#kelurahan').prop('disabled', false);
            $('#kecamatan').prop('disabled', false);
            $('#kota').prop('disabled', false);
            $('#provinsi').prop('disabled', false);
            $('#tagihan_listrik').prop('disabled', false);
            $('#luas_bangunan').prop('disabled', false);
            $('#kepala_keluarga').prop('disabled', false);
            return true;
        });
        $(document).ready(function() {
            changeJenisData(
                '{{ old('jenis_data', empty(session()->get('formState')['jenis_data']) ? 'Data Baru' : session()->get('formState')['jenis_data']) }}'
            );
            selectKK(
                '{{ empty(session()->get('formState')['no_kk']) ? '' : session()->get('formState')['no_kk'] }}',
                '{{ old('jenis_data', empty(session()->get('formState')['jenis_data']) ? 'Data Baru' : session()->get('formState')['jenis_data']) }}'
            );
            selectRT('{{ empty(session()->get('formState')['RT']) ? '' : session()->get('formState')['RT'] }}')

            dataWarga = $('#daftarWarga').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('penduduk.keluarga.tambah.listwarga') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.no_kk = $('#no_kk-list').val();
                    }
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
                // order: [
                //     [2, 'asc']
                // ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-w-[44px]",
                    orderable: false,
                    searchable: false
                }, {
                    data: "NIK",
                    className: "tw-w-[180px]",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama",
                    className: "tw-grow",
                    orderable: false,
                    searchable: false
                }, {
                    data: "status_keluarga",
                    className: "tw-w-[180px]",
                    orderable: false,
                    searchable: false
                }, {
                    data: "action",
                    className: "tw-w-[140px] tw-flex tw-items-center tw-justify-center tw-gap-2",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#no_kk-list').on('change', function () {
                dataWarga.ajax.reload();
            });
        });

        // function getFormData($form) {
        //     var unindexed_array = $form.serializeArray();
        //     var indexed_array = {};
        //     $.map(unindexed_array, function(n, i) {
        //         indexed_array[n['name']] = n['value'];
        //     });
        //     return indexed_array;
        // }

        // function tambahAnggotaKeluarga() {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     var kk = document.getElementById("no_kk");
        //     var url = "/penduduk/warga/tambah/" + kk.value;

        //     data = $('#formdata');
        //     data = getFormData(data);
        //     $.ajax({
        //         type: "POST",
        //         url: "/penduduk/keluarga/tambah/save-state",
        //         data: JSON.stringify(data),
        //         dataType: "json",
        //         success: function(response) {
        //             window.location.href = url;
        //         }
        //     });
        // }

        function data_lama() {
            $('#formData').attr('action', '{{ route('pindahKK') }}');

            $("label[for='no_kk']").attr('for', 'no_kk-list');
            $("label[for='no_kk-list']").children().remove();
            $("label[for='no_kk-list']").append(`<x-input.select2 name="no_kk" searchable
                                    placeholder="Pilih No KK"></x-input.select2>`);

            // $('#no_kk').removeClass('tw-input-enabled');
            // $('#no_kk').attr('type', 'hidden');
            // $('#no_kk').prop('disabled', true);

            // $('#kepala_keluarga').val('');
            $('#kepala_keluarga').removeClass('tw-input-enabled');
            $('#kepala_keluarga').addClass('tw-input-disabled');
            // $('#kepala_keluarga').addClass('tw-input-disabled placeholder:tw-text-n600');
            $('#kepala_keluarga').attr('placeholder', 'Pilih No KK');
            $('#kepala_keluarga').prop('readonly', true);

            // $('#alamat').val('');
            $('#alamat').removeClass('tw-input-enabled');
            $('#alamat').addClass('tw-input-disabled');
            $('#alamat').attr('placeholder', 'Pilih No KK');
            $('#alamat').prop('disabled', true);

            // $('#RT').removeClass('tw-input-enabled');
            // $('#RT').addClass('tw-input-disabled placeholder:tw-text-n600');
            // $('#RT').attr('placeholder', 'Pilih No KK');
            // $('#RT').prop('disabled', true);

            // $('#tagihan_listrik').val('');
            $('#tagihan_listrik').removeClass('tw-input-enabled');
            $('#tagihan_listrik').addClass('tw-input-disabled');
            $('#tagihan_listrik').attr('placeholder', 'Pilih No KK');
            $('#tagihan_listrik').prop('disabled', true);
            
            // $('#luas_bangunan').val('');
            $('#luas_bangunan').removeClass('tw-input-enabled');
            $('#luas_bangunan').addClass('tw-input-disabled');
            $('#luas_bangunan').attr('placeholder', 'Pilih No KK');
            $('#luas_bangunan').prop('disabled', true);

            // $('#no_kk-list').addClass('tw-input-enabled');
            // $('#no_kk-list').parent().removeClass('tw-hidden');
            // $('#no_kk-list').prop('disabled', false);

            // $('#no_kk-list').val('no').change();
            // $.ajax({
            //     type: "GET",
            //     url: "/api/keluarga",
            //     success: function(response) {
            //         // console.log(response);
            //         response.forEach(keluarga => {
            //             let optionHTML =
            //                 `<option value="${keluarga.no_kk}">${keluarga.no_kk} - ${keluarga.kepala_keluarga}</option>`;
            //             $('#no_kk-list').append(optionHTML);
            //         });
            //         $('#no_kk-list').val(
            //             '{{ empty(session()->get('formState')['no_kk']) ? 'no' : (session()->get('formState')['jenis_data'] == 'data_baru' ? 'no' : session()->get('formState')['no_kk']) }}'
            //         ).change();
            //         // $('#no_kk-list').val('no').change();
            //         // console.log('{{ empty(session()->get('formState')['no_kk']) ? 'no' : session()->get('formState')['no_kk'] }}');
            //     }
            // });
            // $('#no_kk-list').val(
            //     '{{ empty(session()->get('formState')['no_kk']) ? 'no' : (session()->get('formState')['jenis_data'] == 'data_baru' ? 'no' : session()->get('formState')['no_kk']) }}'
            // ).change();

        }

        function data_baru() {
            $('#formData').attr('action', '{{ route('tambah-warga-post') }}');
            // $('#no_kk').addClass('tw-input-enabled');
            // $('#no_kk').attr('type', 'text');
            // $('#no_kk').prop('disabled', false);

            $("label[for='no_kk-list']").attr('for', 'no_kk');
            $("label[for='no_kk']").children().remove();
            $("label[for='no_kk']").append(
                `<x-input.input maxlength=16 type="text" name="no_kk" placeholder="Masukkan No KK"
                                    value="{{ old('no_kk', isset($formState['no_kk']) ? $formState['no_kk'] : '') }}"></x-input.input>`
            );

            $('#kepala_keluarga').val('');
            $('#kepala_keluarga').addClass('tw-input-enabled');
            $('#kepala_keluarga').removeClass('tw-input-disabled');
            $('#kepala_keluarga').attr('placeholder', 'Masukkan Kepala Keluarga');
            $('#kepala_keluarga').prop('readonly', false);

            $('#alamat').val('');
            $('#alamat').addClass('tw-input-enabled');
            $('#alamat').removeClass('tw-input-disabled');
            $('#alamat').attr('placeholder', 'Masukkan Alamat');
            $('#alamat').prop('disabled', false);

            // $('#RT').val('001');
            // $('#RT').addClass('tw-input-enabled');
            // $('#RT').removeClass('tw-input-disabled placeholder:tw-text-n600');
            // $('#RT').attr('placeholder', 'Masukkan Tempat Lahir');
            // $('#RT').prop('disabled', false);

            $('#tagihan_listrik').val('');
            $('#tagihan_listrik').addClass('tw-input-enabled');
            $('#tagihan_listrik').removeClass('tw-input-disabled');
            $('#tagihan_listrik').attr('placeholder', 'Misal: 100000');
            $('#tagihan_listrik').prop('disabled', false);
            
            $('#luas_bangunan').val('');
            $('#luas_bangunan').addClass('tw-input-enabled');
            $('#luas_bangunan').removeClass('tw-input-disabled');
            $('#luas_bangunan').attr('placeholder', 'Misal: 100');
            $('#luas_bangunan').prop('disabled', false);

            // $('#no_kk-list').removeClass('tw-input-enabled');
            // $('#no_kk-list').parent().addClass('tw-hidden');
            // $('#no_kk-list').prop('disabled', true);
        }

        function changeJenisData(jenisData) {  
            if (jenisData == 'Data Lama') {
                data_lama();
                let button = $('label[for="no_kk-list"]').children();
                let selected = '{{ empty(session()->get('formState')['no_kk']) ? 'no' : (session()->get('formState')['jenis_data'] == 'data_baru' ? 'no' : session()->get('formState')['no_kk']) }}' + ' - ' + '{{ empty(session()->get('formState')['kepala_keluarga']) ? 'no' : (session()->get('formState')['jenis_data'] == 'data_baru' ? 'no' : session()->get('formState')['kepala_keluarga']) }}'
                // console.log($('#no_kk').parents().html());
                $(button).children().first().text(selected);
            }
        }

        function resetNonDefaultValues() {
            $('#no_kk').val('');
            $('#alamat').val('');
            $('#kepala_keluarga').val('');
            $('#RT').val('');
            $('#tagihan_listrik').val('');
            $('#luas_bangunan').val('');
        }

        function selectRT(rt) {
            $('select#RT').val(rt).change();
        }

        function selectKK(no_kk, jenis_data) {
            // console.log(jenis_data);
            if (jenis_data == 'Data Lama') {
                if (no_kk != '') {
                    // console.log(no_kk);
                    $.ajax({
                        type: "GET",
                        url: "/api/keluarga/" + no_kk,
                        success: function(response) {
                            $.each(response, function(key, val) {
                                if (val === null) {
                                    // console.log(val);
                                    $('#' + key).attr('placeholder', '-');
                                }
                                $('#' + key).val(val);
                            });
                            selectRT(response.RT);
                        }
                    });
                }
            }
        }

        $(document).on("click", ".dropdownItem", function() {
            // if ($(this).text() == 'Data Baru' || $(this).text() == 'Data Lama') {
            //     console.log(this.value);
            //     changeJenisData(this.value);
            //     resetNonDefaultValues();
            // }

            if ($(this).text() == 'Data Baru') {
                data_baru();
            }
            if ($(this).text() == 'Data Lama') {
                data_lama();
            }
            if ($('#jenis_data').val() == 'Data Lama' && $(this).parents().parents().parents().attr(
                    'for') == 'no_kk-list') {
                var data = $(this).text().split(' - ');
                var no_kk = data[0];
                selectKK(no_kk, $('#jenis_data').val());
            }

        });


    
    </script>
@endsection


