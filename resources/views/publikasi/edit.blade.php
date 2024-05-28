@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Publikasi /
            <span class="tw-font-bold tw-text-b500">Edit Publikasi</span>
        </p>

        <div class="md:tw-w-full">

            <h1 class="tw-h1 tw-mb-3">Edit Publikasi</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="" method="POST" id="formData"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Detail Publikasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="judul" label="Judul">
                                <x-input.input readonly type="text" name="judul" value="{{ old('judul', $announcement->judul) }}"
                                    placeholder="" disabled></x-input.input>
                                {{-- @error('NIK')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror --}}
                            </x-input.label>

                            <x-input.label for="penulis" label="Nama Penulis">
                                <x-input.input readonly type="text" name="penulis" value="{{ old('penulis', $announcement->penulis) }}"
                                    placeholder="" disabled></x-input.input>
                                {{-- @error('NIK')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror --}}
                            </x-input.label>

                            <x-input.label class="tw-relative" for="kategori-list" label="Kategori">
                                <x-input.select2 name="kategori"
                                    placeholder="Pilih Kategori" default="{{ old('kategori', $announcement->kategori) }}" ></x-input.select2>

                                {{-- @error('jenis_pekerjaan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror --}}
                            </x-input.label>


                            <x-input.label class="tw-relative" for="status_publikasi-list" label="Status">
                                <x-input.select2 name="status_publikasi" placeholder="Ubah Status" default="{{ old('status', $announcement->status) }}"></x-input.select2>
                                {{-- @error('jenis_pekerjaan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror --}}
                            </x-input.label>

                        </div>
                    </div>
                </div>


                <div class="tw-flex tw-justify-between tw-w-full">
                    <a href="{{ route('publikasi.detail', ['id'=>'1']) }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
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
