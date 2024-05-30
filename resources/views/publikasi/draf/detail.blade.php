@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">

        <p class="tw-breadcrumb tw-text-n500">Daftar Publikasi /
            <span class="tw-font-bold tw-text-b500">Detail Publikasi</span>
        </p>

        <div class="md:tw-w-full">

            <div class="tw-flex tw-w-full tw-justify-between tw-items-center tw-pb-2">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Publikasi</h1>
                <a href="{{ route('publikasi.draf.ubah', ['id' => $announcement->kode]) }}"
                    class="tw-btn tw-btn-primary tw-btn-md-ilead tw-rounded-full" type="button">
                    <x-icons.actionable.edit class="" stroke="2" size="20"
                        color="n100"></x-icons.actionable.edit>
                    <span class="">
                        Perbarui
                    </span>
                </a>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Informasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            @include('components.form.textdetail', [
                                'title' => 'Penulis',
                                'content' => $announcement->penulis,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Dibuat',
                                'content' => $announcement->tanggal_dibuat,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Dipublish',
                                'content' => $announcement->tanggal_publish,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kategori',
                                'content' => $announcement->kategori,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status',
                                'isLabel' => true,
                                'content' => $announcement->status,
                            ])
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Preview Publikasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            <x-publikasi.index title="{{$announcement->judul}}" created_at="{{$announcement->tanggal_dibuat}}" writer="{{$announcement->penulis}}">
                                {!!$announcement->isi!!}
                            </x-publikasi.index>
                        </div>
                    </div>


                </div>


                <div class="tw-flex">
                    <a href="{{ route('publikasi.draf') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
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
            alert('{{ Session::get('message') }}');
        </script>
    @endif
@endsection
