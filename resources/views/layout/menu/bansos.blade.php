<a href="{{route('kriteria')}}" id="bansos" class="tw-group tw-flex tw-h-9 tw-gap-1 tw-content-center tw-items-center tw-px-3 tw-rounded-md {{ (Route::currentRouteName() == 'kriteria') ? ' tw-bg-b500 tw-outline tw-outline-2 tw-outline-b300 ' : 'tw-bg-n100 hover:tw-bg-n200' }}">
    <x-icons.actionable.bansos  stroke="2" size="20" active="{{ (Route::currentRouteName() == 'kriteria') || (Route::currentRouteName() == 'perhitungan') ? true : false }}"></x-icons.actionable.bansos>
    <p class="tw-menu-text {{ (Route::currentRouteName() == 'kriteria') ? 'tw-text-n100' : 'tw-text-n1000' }}">Bansos</p>
</a>

