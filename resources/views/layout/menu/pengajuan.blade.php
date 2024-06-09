@php
    use App\Models\PengajuanData;
@endphp
<a href="{{ route('pengajuan') }}" id="pengajuan"
    class="tw-group tw-relative tw-flex tw-h-9 tw-gap-1 tw-content-center tw-items-center tw-px-3 tw-rounded-md {{ Route::currentRouteName() == 'pengajuan' || Route::currentRouteName() == 'perubahanWarga' || Route::currentRouteName() == 'perubahanKeluarga' ? ' tw-bg-b500 tw-outline tw-outline-2 tw-outline-b300 ' : 'tw-bg-n100 hover:tw-bg-n200' }}">
    @if (
        (Auth::user()->keterangan !== 'ketua' &&
            PengajuanData::where('user_id', Auth::user()->user_id)->where('status_request', '=', 'Menunggu')->count() > 0) ||
            (Auth::user()->keterangan === 'ketua' && PengajuanData::where('status_request', '=', 'Menunggu')->count()))
        <div
            class="tw-absolute tw-bg-r500 tw-rounded-full tw-h-2 tw-w-2 tw-outline tw-outline-2 tw-outline-n100 tw-top-3 -tw-translate-y-1/2 tw-left-3">
        </div>
    @endif
    <x-icons.actionable.pengajuan stroke="2" size="20"
        active="{{ Route::currentRouteName() == 'pengajuan' || Route::currentRouteName() == 'perubahanWarga' || Route::currentRouteName() == 'perubahanKeluarga' ? true : false }}"></x-icons.actionable.pengajuan>
    <p
        class="tw-menu-text {{ Route::currentRouteName() == 'pengajuan' || Route::currentRouteName() == 'perubahanWarga' || Route::currentRouteName() == 'perubahanKeluarga' ? 'tw-text-n100' : 'tw-text-n1000' }}">
        Pengajuan</p>
</a>
