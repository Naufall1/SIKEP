@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <p class="tw-breadcrumb tw-text-n500">Daftar Publikasi /
            <span class="tw-font-bold tw-text-b500">Edit Publikasi</span>
        </p>

        <div class="md:tw-w-full">
            <h1 class="tw-h1 tw-mb-3">Edit Publikasi</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('publikasi.draf.update',  ['id' => $announcement->kode])}}" method="POST" id="formData"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">
                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Detail Publikasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="judul" label="Judul">
                                <x-input.input type="text" name="judul" placeholder="Masukkan Judul" value="{{ old('judul', $announcement->judul) }}"></x-input.input>
                                @error('judul')
                                <small class="form-text tw-text-red-600">{{ $message }}</small>

                                @enderror
                            </x-input.label>

                            <x-input.label for="penulis" label="Nama Penulis">
                                <x-input.input type="text" name="penulis" placeholder="" value="{{ old('penulis', $announcement->penulis) }}" disabled></x-input.input>
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
                                <x-input.input type="text" name="caption" placeholder="Masukkan Caption" value="{{ old('caption', $announcement->caption) }}"></x-input.input>
                                @error('caption')
                                <small class="form-text tw-text-red-600">{{ $message }}</small>

                                @enderror
                            </x-input.label>

                            <x-input.label for="isi" label="Isi">
                                {{-- <textarea id="isi" name="isi" placeholder="Masukkan Isi">{{ old('isi', $announcement->isi) }}</textarea> --}}
                                <x-input.textarea class="tw-h-64" name="isi" placeholder="Masukkan Isi Publikasi"
                                    value="{{ old('isi', $announcement->isi) }}">
                                </x-input.textarea>
                                @error('isi')
                                <small class="form-text tw-text-red-600">{{ $message }}</small>

                                @enderror
                            </x-input.label>

                            <x-input.label class="tw-relative" for="kategori" label="Kategori">
                                <x-input.input type="text" name="kategori" placeholder="" value="{{ old('kategori', $announcement->kategori) }}" disabled></x-input.input>
                                @error('kategori')
                                <small class="form-text tw-text-red-600">{{ $message }}</small>

                                @enderror
                            </x-input.label>

                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-justify-between tw-w-full">
                    <a href="{{ route('publikasi.draf.detail', ['id' => $announcement->kode]) }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline" type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5" color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">Kembali</span>
                    </a>
                    <button type="submit" class="tw-h-11 tw-flex tw-px-6 tw-bg-b500 tw-text-n100 tw-items-center tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
{{-- <script src="https://cdn.tiny.cloud/1/z0hhm5m2sapddlcptxbuiww7jy2drthhz0q3sk33ev5imf3n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script>
    $(document).ready(function(){

        $('#formData').submit(function(){
            var currentDate = new Date().toISOString().slice(0,10);
            $('#tanggal_edit').val(currentDate);
            $('#tanggal_publish').val(currentDate);
        });
    });
</script>
@endpush
