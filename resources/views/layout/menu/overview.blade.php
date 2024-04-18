<a href="{{route('home')}}" id="overview" class="tw-group tw-flex tw-h-9 tw-gap-1 tw-content-center tw-items-center tw-px-3 tw-rounded-md {{ (Route::currentRouteName() == 'home')? ' tw-bg-b500 tw-outline tw-outline-2 tw-outline-b300 ' : 'tw-bg-n100 hover:tw-bg-n200' }}">
    <x-icons.actionable.home stroke="2" size="20" active="{{ (Route::currentRouteName() == 'home') ? true : false }}"></x-icons.actionable.home>
    <p class="tw-menu-text {{ (Route::currentRouteName() == 'home') ? 'tw-text-n100' : 'tw-text-n1000' }}" >Overview</p>
</a>