@extends('layout.layout', ['isForm' => false])

@section('content')
    <div id="modalReject"
        class="tw-hidden modal-menu tw-z-20 tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
        <div
            class="tw-w-96 md:tw-w-96 tw-relative tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] ">
            <div class="tw-flex tw-items-center tw-px-4 tw-h-14 tw-border-b-[1px]">
                <h2>Tolak Pengajuan</h2>
            </div>
            <div id="navMenus" class="tw-flex tw-gap-4 tw-w-full tw-flex-col tw-p-4">
                <form class="tw-flex tw-flex-col tw-gap-7 tw-items-end" action="{{route('pengajuan.reject.perubahan.keluarga')}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="tw-flex tw-flex-col tw-gap-3 tw-w-full">
                        <input type="hidden" name="id" value="{{$pengajuan->id}}">

                        <x-input.label for="catatan" label="Catatan">
                            <x-input.textarea class="tw-h-32" name="catatan" placeholder="Catatan"></x-input.textarea>
                        </x-input.label>

                    </div>

                    <div class="tw-flex tw-gap-2">
                        <button class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                            id="closeModal">Batal</button>
                        <button class="tw-btn tw-btn-danger tw-btn-lg tw-btn-round" type="submit">Tolak</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[754px] tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        @if (session()->has('flash'))
            <x-flash-message.information message="{{session()->get('flash')->message}}"></x-flash-message.information>
        @else
        @endif {{-- DONT DELETE THIS LINE --}}
        <p class="tw-breadcrumb tw-text-n500">Daftar Data Baru /
            <span class="tw-font-bold tw-text-b500">Detail Pengajuan</span>
        </p>

        <div class="md:tw-w-full">

            <div class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Pengajuan</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Informasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            @include('components.form.textdetail', [
                                'title' => 'Jenis',
                                'content' => $pengajuan->tipe,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Pengajuan',
                                'content' => $pengajuan->status_request,
                                'isLabel' => true,
                            ])
                            @if ($pengajuan->status_request === 'Ditolak')
                                @include('components.form.textdetail', [
                                    'title' => 'Catatan',
                                    'content' => $pengajuan->catatan,
                                ])
                            @endif

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col md:tw-flex-row-reverse tw-justify-between">
                        <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                            <h2 class="">Detail Keluarga Baru</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                @include('components.form.textdetail', [
                                    'title' => 'No KK',
                                    'content' => $modifiedKeluarga->no_kk,
                                ])
                                @include('components.form.textdetail', [
                                    'title' => 'Kepala Keluarga',
                                    'content' => $modifiedKeluarga->kepala_keluarga,
                                ])
                                @if ($modifiedKeluarga->tagihan_listrik != $currentKeluarga->tagihan_listrik)
                                    @include('components.form.textdetail', [
                                        'title' => 'Tagihan Listrik',
                                        'content' => 'Rp ' . number_format( $modifiedKeluarga->tagihan_listrik, 0, ",", "."),

                                    ])
                                @endif
                                @if ($modifiedKeluarga->luas_bangunan != $currentKeluarga->luas_bangunan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Luas Bangunan',
                                        'content' => $modifiedKeluarga->luas_bangunan . ' m²',
                                    ])
                                @endif
                                @if ($modifiedKeluarga->image_kk != $currentKeluarga->image_kk)
                                    @include('components.form.textdetail', [
                                        'title' => 'Kartu Keluarga',
                                        'isImage' => true,
                                        'content' => $pengajuan->status_request == 'Dikonfirmasi'
                                            ? asset(Storage::disk('public')->url('KK/' . $modifiedKeluarga->image_kk)) :
                                            'data:image/' .
                                                explode('.', $modifiedKeluarga->image_kk)[1] .
                                                ';base64, ' .
                                                base64_encode(Storage::disk('temp')->get(
                                                        $modifiedKeluarga->image_kk)),
                                    ]) {{-- kalau label kasih value var $isLabel with true --}}
                                @endif
                            </div>
                        </div>

                        <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                            <h2 class="">Detail Keluarga Lama</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                @include('components.form.textdetail', [
                                    'title' => 'No KK',
                                    'content' => $currentKeluarga->no_kk,
                                ])
                                @include('components.form.textdetail', [
                                    'title' => 'Kepala Keluarga',
                                    'content' => $currentKeluarga->kepala_keluarga,
                                ])
                                @if ($modifiedKeluarga->tagihan_listrik != $currentKeluarga->tagihan_listrik)
                                    @include('components.form.textdetail', [
                                        'title' => 'Tagihan Listrik',
                                        'content' => 'Rp ' . number_format( $currentKeluarga->tagihan_listrik, 0, ",", "."),

                                    ])
                                @endif
                                @if ($modifiedKeluarga->luas_bangunan != $currentKeluarga->luas_bangunan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Luas Bangunan',
                                        'content' => $currentKeluarga->luas_bangunan . ' m²',
                                    ])
                                @endif
                                @if ($modifiedKeluarga->image_kk != $currentKeluarga->image_kk)
                                    @include('components.form.textdetail', [
                                        'title' => 'Kartu Keluarga',
                                        'isImage' => true,
                                        'content' => !isset($modifiedKeluarga->image_kk)
                                            ? ''
                                            : asset(Storage::disk('public')->url(
                                                    'KK/' . $currentKeluarga->image_kk)),
                                    ]) {{-- kalau label kasih value var $isLabel with true --}}
                                @endif
                            </div>
                        </div>

                    </div>

                </div>


                <div class="tw-flex tw-justify-between">
                    <a href="{{route('pengajuan')}}" class="tw-btn tw-btn-outline tw-btn-lg-ilead tw-btn-round"
                        type="button">
                        <x-icons.actionable.arrow-left class="tw-btn-i-lead-lg" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    @if ($user == 1 && $pengajuan->status_request == 'Menunggu')
                        <div class="tw-flex tw-gap-2">
                            <button href="" class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                                id="buttonReject">Tolak</button>
                            {{-- <a href="" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Konfirmasi</a> --}}
                            <form class="d-inline-block" method="POST"
                                action="{{ route('pengajuan.confirm.perubahan.keluarga') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="id" value="{{ $pengajuan->id }}">
                                <button type="submit" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round"
                                    onclick="return confirm('Apakah Anda yakin melakukan konfirmasi data ini?');">Konfirmasi</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#buttonReject").click(function() {
                $("#modalReject").removeClass("tw-hidden");
                $('html, body').css({
                    overflow: 'hidden',
                });
            });
            $("#modalReject #closeModal").click(function() {
                $("#modalReject").addClass("tw-hidden");
                $('html, body').css({
                    overflow: 'auto',
                });
            });
        });
    </script>
@endsection
