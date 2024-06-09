@extends('layout.layout', ['isForm' => true])

@section('content')
    <div
        class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <p class="tw-breadcrumb tw-text-n500">Daftar Publikasi /
            <span class="tw-font-bold tw-text-b500">Tambah Publikasi</span>
        </p>

        <div class="md:tw-w-full">

            <h1 class="tw-h1 tw-mb-3">Tambah Publikasi</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="" method="POST" id="formData"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Detail Publikasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="judul" label="Judul">
                                <x-input.input type="text" name="judul" placeholder="Masukkan Judul"
                                    value="{{ old('judul') }}"></x-input.input>
                                @error('judul')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="penulis" label="Nama Penulis">
                                <x-input.input type="text" name="penulis" placeholder="{{ $user->nama }}"
                                    disabled></x-input.input>
                                @error('penulis')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="gambar" label="Gambar">
                                <x-input.file id="gambar" name="gambar"></x-input.file>
                                @error('gambar')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="caption" label="Caption">
                                <x-input.input type="text" name="caption" value="{{ old('caption') }}"
                                    placeholder="Masukkan Caption"></x-input.input>

                                @error('caption')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label required for="content" label="Isi">
                                <x-input.textarea class="tw-h-56" name="isi" placeholder="Masukkan Isi Publikasi"
                                    value="{{ old('isi', isset($formState['isi']) ? $formState['isi'] : '') }}">
                                </x-input.textarea>
                                @error('isi')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <x-input.label class="tw-relative" for="kategori" label=""> --}}
                                {{-- <x-input.select2 name="kategori" placeholder="Pilih Kategori"
                                    selected="{{ old('kategori') }}"></x-input.select2> --}}
                                    <x-input.input type="hidden" name="kategori" value="Pengumuman"
                                    placeholder=""></x-input.input>
                                {{-- @error('kategori')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror --}}
                            {{-- </x-input.label> --}}
                            
                            <x-input.label for="status" label="">

                                <input type="checkbox" name="status" id="status" value="Ditampilkan" class="tw-peer tw-hidden">
                                <div id="statusContainer"
                                    class="tw-flex tw-gap-2 items-center tw-w-full tw-p-3 tw-bg-n100 tw-group tw-items-center peer-checked:tw-bg-b50 tw-border-[1.5px] tw-rounded-md tw-cursor-pointer tw-border-n400 peer-checked:tw-border-b200">
                                    <div id="iconTick" class="tw-w-5 tw-h-5 tw-bg-[url('/public/img/uncheck.svg')]"></div>
                                    <div class="tw-flex tw-flex-col tw-gap-1">
                                        <h4 class="tw-font-semibold tw-font-sans tw-text-base tw-text-n1000">Langsung Unggah Pengumuman?</h4>
                                        <p class="tw-font-medium tw-font-sans tw-text-sm tw-text-n800">Setelah tersimpan, pengumuman akan langsung ditampilkan di Halaman Utama</p>
                                    </div>
                                </div>

                                @error('status')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-justify-between tw-w-full">
                    <a href="{{ route('publikasi') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                        type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button type="submit"
                        class="tw-h-11 tw-flex tw-px-6 tw-bg-b500 tw-text-n100 tw-items-center tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('js')
    <script>
        function updatePublishDate() {
            var currentDate = new Date().toISOString().slice(0, 10);
            document.getElementById('tanggal_publish').value = currentDate;
        }

        function clearPublishDate() {
            document.getElementById('tanggal_publish').value = '';
        }

        $(document).ready(function () {
            $(document).on('change', '#status', function () {
                console.log($(this).is(':checked'));
                if ($(this).is(':checked')) {
                    $('#iconTick').removeClass("tw-bg-[url('/public/img/uncheck.svg')]");
                    $('#iconTick').addClass("tw-bg-[url('/public/img/checked.svg')]");
                } else {
                    $('#iconTick').removeClass("tw-bg-[url('/public/img/checked.svg')]");
                    $('#iconTick').addClass("tw-bg-[url('/public/img/uncheck.svg')]");
                }
            });
        });
    </script>
@endpush
