@extends('layout.layout', ['isForm' => true])

@section('content')
    <div
        class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <p class="tw-breadcrumb tw-text-n500">Daftar Warga / Detail Warga /
            <span class="tw-font-bold tw-text-b500">Perbarui Data</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Perbarui Data Warga</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('warga-edit', ['nik' => $warga->NIK]) }}"
                method="POST" id="formData" enctype="multipart/form-data">
                {{ csrf_field() }}
                {!! method_field('PUT') !!}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Identitas Warga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3" id="identitasWarga">

                            <x-input.label for="nik" label="NIK">
                                <x-input.input value="{{ $warga->NIK }}" type="text" id="nik" name="nik"
                                    disabled></x-input.input>
                            </x-input.label>

                            <x-input.label for="nama" label="Nama">
                                <x-input.input value="{{ $warga->nama }}" type="text" id="nama" name="nama"
                                    disabled></x-input.input>
                            </x-input.label>

                            <x-input.label for="tempat_lahir" label="Tempat Lahir">
                                <x-input.input value="{{ $warga->tempat_lahir }}" type="text" id="tempat_lahir"
                                    name="tempat_lahir" disabled></x-input.input>
                            </x-input.label>

                            <x-input.label for="tanggal_lahir" label="Tanggal Lahir">
                                <x-input.input value="{{ $warga->tanggal_lahir }}" type="date" id="tanggal_lahir"
                                    name="tanggal_lahir" disabled></x-input.input>
                            </x-input.label>

                            <x-input.label for="jenis_kelamin" label="Jenis Kelamin">
                                <x-input.input value="{{ $warga->jenis_kelamin }}" type="text" id="jenis_kelamin"
                                    name="jenis_kelamin" disabled></x-input.input>
                            </x-input.label>

                            {{-- @dd($warga_edited->pendidikan) --}}

                            @if ($warga->pendidikan != ($warga_edited->pendidikan ?? $warga->pendidikan))
                                <x-input.label class="tw-relative" for="pendidikan-list" edited label="Pendidikan">
                                    <x-input.select2 name="pendidikan"
                                        default="{{ old('pendidikan', $warga_edited->pendidikan ?? $warga->pendidikan) }}"
                                        placeholder="Pilih Pendidikan"></x-input.select2>
                                    @error('pendidikan')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @else
                                <x-input.label class="tw-relative" for="pendidikan-list" label="Pendidikan">
                                    <x-input.select2 name="pendidikan"
                                        default="{{ old('pendidikan', $warga_edited->pendidikan ?? $warga->pendidikan) }}"
                                        placeholder="Pilih Pendidikan"></x-input.select2>
                                    @error('pendidikan')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @endif

                            @if ($warga->agama != ($warga_edited->agama ?? $warga->agama))
                                <x-input.label edited class="tw-relative" for="agama-list" label="Agama">
                                    <x-input.select2 name="agama"
                                        default="{{ old('agama', $warga_edited->agama ?? $warga->agama) }}"
                                        placeholder="Pilih Agama"></x-input.select2>
                                    @error('agama')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @else
                                <x-input.label class="tw-relative" for="agama-list" label="Agama">
                                    <x-input.select2 name="agama"
                                        default="{{ old('agama', $warga_edited->agama ?? $warga->agama) }}"
                                        placeholder="Pilih Agama"></x-input.select2>
                                    @error('agama')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @endif

                            @if ($warga->status_perkawinan != ($warga_edited->status_perkawinan ?? $warga->status_perkawinan))
                                <x-input.label edited class="tw-relative" for="status_perkawinan-list"
                                    label="Status Perkawinan">
                                    <x-input.select2 name="status_perkawinan"
                                        default="{{ old('status_perkawinan', $warga_edited->status_perkawinan ?? $warga->status_perkawinan) }}"
                                        placeholder="Pilih Status Perkawinan"></x-input.select2>
                                    @error('status_perkawinan')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @else
                                <x-input.label class="tw-relative" for="status_perkawinan-list" label="Status Perkawinan">
                                    <x-input.select2 name="status_perkawinan"
                                        default="{{ old('status_perkawinan', $warga_edited->status_perkawinan ?? $warga->status_perkawinan) }}"
                                        placeholder="Pilih Status Perkawinan"></x-input.select2>
                                    @error('status_perkawinan')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @endif

                            @if ($warga->jenis_pekerjaan != ($warga_edited->jenis_pekerjaan ?? $warga->jenis_pekerjaan))
                                <x-input.label edited class="tw-relative" for="jenis_pekerjaan-list"
                                    label="Jenis Pekerjaan">
                                    <x-input.select2 searchable name="jenis_pekerjaan"
                                        default="{{ old('jenis_pekerjaan', $warga_edited->jenis_pekerjaan ?? $warga->jenis_pekerjaan) }}"
                                        placeholder="Pilih Jenis Pekerjaan"></x-input.select2>
                                    @error('jenis_pekerjaan')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @else
                                <x-input.label class="tw-relative" for="jenis_pekerjaan-list" label="Jenis Pekerjaan">
                                    <x-input.select2 searchable name="jenis_pekerjaan"
                                        default="{{ old('jenis_pekerjaan', $warga_edited->jenis_pekerjaan ?? $warga->jenis_pekerjaan) }}"
                                        placeholder="Pilih Jenis Pekerjaan"></x-input.select2>
                                    @error('jenis_pekerjaan')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                            @endif

                            <x-input.label for="kewarganegaraan" label="Kewarganegaraan">
                                <x-input.input value="{{ $warga->kewarganegaraan }}" type="text" id="kewarganegaraan"
                                    name="kewarganegaraan" disabled></x-input.input>
                            </x-input.label>

                            {{-- @dd(isset($demografi->demografi->jenis)) --}}

                            @if (isset($demografi) && ($demografi->demografi->jenis != ($haveDemografi_edited->demografi->jenis ?? $demografi->demografi->jenis)))
                                <x-input.label edited class="tw-relative" for="jenis_demografi_keluar-list"
                                    label="Status Warga">
                                    @if ($demografi && ($demografi->demografi->jenis == 'Meninggal' || $demografi->demografi->jenis == 'Migrasi Keluar'))
                                        <x-input.input name="jenis_demografi_keluar" id="jenis_demografi_keluar" disabled
                                            value="{{ $demografi->demografi->jenis }}">
                                        </x-input.input>
                                    @else
                                        <x-input.select2 name="jenis_demografi_keluar" {{-- default="{{ old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : 'Aktif') }}" --}}
                                            default="{{ old('jenis_demografi_keluar', $demografi || $haveDemografi_edited ? $haveDemografi_edited->demografi->jenis ?? ($demografi->demografi->jenis != 'Lahir' ? $demografi->demografi->jenis : ($demografi->demografi->jenis != 'Migrasi Masuk' ? $demografi->demografi->jenis : 'Aktif')) : 'Aktif') }}"
                                            placeholder="Pilih Status Warga"></x-input.select2>
                                    @endif
                                </x-input.label>
                            @else
                                <x-input.label class="tw-relative" for="jenis_demografi_keluar-list"
                                    label="Status Warga">
                                    @if ($demografi && ($demografi->demografi->jenis == 'Meninggal' || $demografi->demografi->jenis == 'Migrasi Keluar'))
                                        <x-input.input name="jenis_demografi_keluar" id="jenis_demografi_keluar" disabled
                                            value="{{ $demografi->demografi->jenis }}">
                                        </x-input.input>
                                    @else
                                        <x-input.select2 name="jenis_demografi_keluar" {{-- default="{{ old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : 'Aktif') }}" --}}
                                            default="{{ old('jenis_demografi_keluar', $demografi || $haveDemografi_edited ? $haveDemografi_edited->demografi->jenis ?? ($demografi->demografi->jenis != 'Lahir' ? $demografi->demografi->jenis : ($demografi->demografi->jenis != 'Migrasi Masuk' ? $demografi->demografi->jenis : 'Aktif')) : 'Aktif') }}"
                                            placeholder="Pilih Status Warga"></x-input.select2>
                                    @endif
                                </x-input.label>
                            @endif



                            {{-- <x-input.label for="jenis_demografi_keluar" label="Status Warga">
                                @if ($demografi && $demografi->demografi->jenis == 'Meninggal')
                                    <x-input.select name="jenis_demografi_keluar" id="jenis_demografi_keluar" disabled>
                                        <option value="Meninggal" @selected($demografi && $demografi->demografi->jenis == 'Meninggal')>Meninggal</option>
                                    </x-input.select>
                                @elseif (in_array($demografi && $demografi->demografi->jenis, ['Migrasi Masuk', 'Lahir']))
                                    <x-input.select name="jenis_demografi_keluar" id="jenis_demografi_keluar">
                                        <option value="{{ $demografi->demografi->jenis }}" selected>
                                            {{ $demografi->demografi->jenis }} (Saat Ini)</option>
                                        <option value="Migrasi Keluar" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Migrasi Keluar')>Migrasi Keluar
                                        </option>
                                        <option value="Meninggal" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Meninggal')>Meninggal</option>
                                    </x-input.select>
                                @else
                                    <x-input.select name="jenis_demografi_keluar" id="jenis_demografi_keluar">
                                        <option value="" @selected(!$demografi)>Pilih Jenis Demografi</option>
                                        <option value="Lahir" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Lahir')>Lahir</option>
                                        <option value="Migrasi Masuk" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Migrasi Masuk')>Migrasi Masuk</option>
                                        <option value="Migrasi Keluar" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Migrasi Keluar')>Migrasi Keluar
                                        </option>
                                        <option value="Meninggal" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Meninggal')>Meninggal</option>
                                    </x-input.select>
                                @endif
                            </x-input.label> --}}

                            @if (
                                $errors->has('berkas_demografi_keluar') ||
                                    $errors->has('tanggal_kejadian_demografi_keluar') ||
                                    $haveDemografi_edited)
                                @if (
                                    (isset($demografi) && $demografi->tanggal_kejadian != ($haveDemografi_edited->tanggal_kejadian ?? $demografi->tanggal_kejadian)) ||
                                        (is_null($demografi) && isset($haveDemografi_edited->tanggal_kejadian)))
                                    <x-input.label edited for="tanggal_kejadian_demografi_keluar"
                                        label="Tanggal Kejadian">
                                        <x-input.input
                                            value="{{ old('tanggal_kejadian_demografi_keluar', $haveDemografi_edited->tanggal_kejadian ?? '') }}"
                                            placeholder="" type="date" id="tanggal_kejadian_demografi_keluar"
                                            name="tanggal_kejadian_demografi_keluar"></x-input.input>
                                        @error('tanggal_kejadian_demografi_keluar')
                                            <x-input.error-message>{{ $message }}</x-input.error-message>
                                        @enderror
                                    </x-input.label>
                                @else
                                    <x-input.label for="tanggal_kejadian_demografi_keluar" label="Tanggal Kejadian">
                                        <x-input.input
                                            value="{{ old('tanggal_kejadian_demografi_keluar', $haveDemografi_edited->tanggal_kejadian ?? '') }}"
                                            placeholder="" type="date" id="tanggal_kejadian_demografi_keluar"
                                            name="tanggal_kejadian_demografi_keluar"></x-input.input>
                                        @error('tanggal_kejadian_demografi_keluar')
                                            <x-input.error-message>{{ $message }}</x-input.error-message>
                                        @enderror
                                    </x-input.label>
                                @endif

                                @if (
                                    (isset($demografi) && $demografi->dokumen_pendukung != $haveDemografi_edited->dokumen_pendukung) ||
                                        (is_null($demografi) && isset($haveDemografi_edited->dokumen_pendukung)))
                                    <x-input.label edited for="berkas_demografi_keluar" label="Berkas Pendukung">
                                        <x-input.file id="berkas_demografi_keluar"
                                            name="berkas_demografi_keluar"></x-input.file>
                                        @error('berkas_demografi_keluar')
                                            <x-input.error-message>{{ $message }}</x-input.error-message>
                                        @enderror
                                    </x-input.label>
                                @else
                                    <x-input.label for="berkas_demografi_keluar" label="Berkas Pendukung">
                                        <x-input.file id="berkas_demografi_keluar"
                                            name="berkas_demografi_keluar"></x-input.file>
                                        @error('berkas_demografi_keluar')
                                            <x-input.error-message>{{ $message }}</x-input.error-message>
                                        @enderror
                                    </x-input.label>
                                @endif
                                <div id="berkas">
                                    @if (session()->has('berkas_demografi_keluar'))
                                        @php
                                            $img = session()->get('berkas_demografi_keluar');
                                        @endphp
                                        @include('components.form.textdetail', [
                                            'title' => '',
                                            'isImage' => true,
                                            'content' =>
                                                'data:image/' .
                                                $img->ext .
                                                ';base64, ' .
                                                base64_encode(Storage::disk('temp')->get($img->path)),
                                        ])
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            {{-- @dd($warga_edited->status_keluarga) --}}

                            @if ($warga->status_keluarga != ($warga_edited->status_keluarga ?? $warga->status_keluarga))
                                <x-input.label edited class="tw-relative" for="status_keluarga-list" label="Status Keluarga">
                                    <x-input.select2 name="status_keluarga"
                                        default="{{ old('status_keluarga', $warga_edited->status_keluarga) }}"
                                        placeholder="Pilih Status Keluarga"></x-input.select2>
                                </x-input.label>
                                @else
                                <x-input.label class="tw-relative" for="status_keluarga-list" label="Status Keluarga">
                                    <x-input.select2 name="status_keluarga"
                                        default="{{ old('status_keluarga', $warga->status_keluarga) }}"
                                        placeholder="Pilih Status Keluarga"></x-input.select2>
                                </x-input.label>
                            @endif
                            
                            <x-input.label for="nama_ayah" label="Nama Ayah">
                                <x-input.input value="{{ $warga->nama_ayah }}" type="text" id="nama_ayah"
                                    name="nama_ayah" disabled></x-input.input>
                            </x-input.label>

                            <x-input.label for="nama_ibu" label="Nama Ibu">
                                <x-input.input value="{{ $warga->nama_ibu }}" type="text" id="nama_ibu"
                                        name="nama_ibu" disabled></x-input.input>
                            </x-input.label>

                            @if ($warga->penghasilan != ($warga_edited->penghasilan ?? $warga->penghasilan))
                                <x-input.label edited for="penghasilan" label="Penghasilan">
                                    <x-input.leadingicon type="number"
                                        value="{{ old('penghasilan', $warga_edited->penghasilan ?? $warga->penghasilan) }}"
                                        min="0" id="penghasilan" name="penghasilan" placeholder="Misal: 1000000"
                                        icon="rupiah" alt="Rp">
                                    </x-input.leadingicon>
                                </x-input.label>
                                @else
                                <x-input.label for="penghasilan" label="Penghasilan">
                                    <x-input.leadingicon type="number"
                                        value="{{ old('penghasilan', $warga_edited->penghasilan ?? $warga->penghasilan) }}"
                                        min="0" id="penghasilan" name="penghasilan" placeholder="Misal: 1000000"
                                        icon="rupiah" alt="Rp">
                                    </x-input.leadingicon>
                                </x-input.label>
                            @endif

                            @if ($warga->no_paspor != ($warga_edited->no_paspor ?? $warga->no_paspor))
                                <x-input.label edited for="no_paspor" label="Nomor Paspor">
                                    <x-input.input
                                        value="{{ old('no_paspor', $warga_edited->no_paspor ?? $warga->no_paspor) }}"
                                        type="text" id="no_paspor" placeholder="Masukkan Nomor Paspor"
                                        name="no_paspor"></x-input.input>
                                </x-input.label>
                                @else
                                <x-input.label for="no_paspor" label="Nomor Paspor">
                                    <x-input.input
                                        value="{{ old('no_paspor', $warga_edited->no_paspor ?? $warga->no_paspor) }}"
                                        type="text" id="no_paspor" placeholder="Masukkan Nomor Paspor"
                                        name="no_paspor"></x-input.input>
                                </x-input.label>
                            @endif

                            @if ($warga->no_kitas != ($warga_edited->no_kitas ?? $warga->no_kitas))
                                <x-input.label edited for="no_kitas" label="Nomor Kitas">
                                    <x-input.input value="{{ old('no_kitas', $warga_edited->no_kitas ?? $warga->no_kitas) }}"
                                        type="text" id="no_kitas" placeholder="Masukkan Nomor Kitas"
                                        name="no_kitas"></x-input.input>
                                </x-input.label>
                                @else
                                <x-input.label for="no_kitas" label="Nomor Kitas">
                                    <x-input.input value="{{ old('no_kitas', $warga_edited->no_kitas ?? $warga->no_kitas) }}"
                                        type="text" id="no_kitas" placeholder="Masukkan Nomor Kitas"
                                        name="no_kitas"></x-input.input>
                                </x-input.label>
                            @endif
                        </div>
                    </div>
                    @if ($demografi)
                        <div id="demografiMasuk" class="tw-flex tw-flex-col tw-gap-2 tw-pt-6" style="">
                            <h2 class="">Data Demografi</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">
                                <x-input.label for="jenis_demografi" label="Jenis" style="pointer-events: none">
                                    <x-input.input value="{{ $demografi->demografi->jenis }}" type="text"
                                        id="jenis_demografi" placeholder="" disabled
                                        name="jenis_demografi"></x-input.input>
                                </x-input.label>

                                <x-input.label for="tanggal_kejadian" label="Tanggal Kejadian">
                                    <x-input.input readonly class="tw-input-disabled"
                                        value="{{ old('tanggal_kejadian', $demografi ? $demografi->tanggal_kejadian : '') }}"
                                        placeholder="" type="date" id="tanggal_kejadian"
                                        name="tanggal_kejadian"></x-input.input>
                                    @error('tanggal_kejadian')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>

                                <x-input.label for="berkas_demografi" label="Berkas Pendukung">
                                    <x-input.file id="berkas_demografi" name="berkas_demografi"></x-input.file>
                                    @error('berkas_demografi')
                                        <x-input.error-message>{{ $message }}</x-input.error-message>
                                    @enderror
                                </x-input.label>
                                <div id="berkas">
                                    @php
                                        $filename = $demografi->dokumen_pendukung;
                                        $img = (object) [
                                            'ext' => explode('.', $filename)[1],
                                            'path' => $filename,
                                        ];
                                    @endphp
                                    @include('components.form.textdetail', [
                                        'title' => '',
                                        'isImage' => true,
                                        'content' =>
                                            'data:image/' .
                                            $img->ext .
                                            ';base64, ' .
                                            base64_encode(Storage::disk('temp')->get($img->path)),
                                    ])
                                </div>

                            </div>
                        </div>
                    @endif
                </div>

                <div class="tw-flex tw-justify-between tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('wargaDetail', ['nik' => $warga->NIK]) }}"
                        class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline" type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button type="submit" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    @push('js')
        <script>
            function getJenisDemografi() {
                return ['Aktif', 'Migrasi Keluar', 'Meninggal'];
            }
        </script>
    @endpush

    <script>
        function addBerkas() {
            removeBerkas();
            const fileStatusWarga = `
                    <x-input.label for="berkas_demografi_keluar" label="Berkas Pendukung">
                        <x-input.file id="berkas_demografi_keluar" name="berkas_demografi_keluar"></x-input.file>
                        @error('berkas_demografi')
                            <x-input.error-message>{{ $message }}</x-input.error-message>
                        @enderror
                    </x-input.label>`;
            const tanggalKejadian = `
                    <x-input.label for="tanggal_kejadian_demografi_keluar" label="Tanggal Kejadian">
                        <x-input.input value="{{ old('tanggal_kejadian_demografi_keluar') }}" placeholder="" type="date"
                            id="tanggal_kejadian_demografi_keluar" name="tanggal_kejadian_demografi_keluar"></x-input.input>
                        @error('tanggal_kejadian_demografi_keluar')
                            <x-input.error-message>{{ $message }}</x-input.error-message>
                        @enderror
                    </x-input.label>
                `;
            $('#identitasWarga').append(tanggalKejadian);
            $('#identitasWarga').append(fileStatusWarga);
            $('#demografiMasuk').css('display', 'none');
        }

        function removeBerkas() {
            $('#berkas_demografi_keluar').parent().parent().remove();
            $('#tanggal_kejadian_demografi_keluar').parent().remove();
            $('#berkas').remove();
            $('#demografiMasuk').css('display', 'flex');
        }

        $(document).ready(function() {
            $(document).on("click", ".dropdownItem", function() {
                if ($(this).text() == 'Meninggal' || $(this).text() == 'Migrasi Keluar') {
                    addBerkas();
                }
                if ($(this).text() == 'Aktif') {
                    removeBerkas();
                }
            });

        });
    </script>
@endsection
