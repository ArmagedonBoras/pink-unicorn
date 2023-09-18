<x-app-layout>
    <x-slot name="title">
        Bokningssystemets inställningar
    </x-slot>
    <form method="POST" action="{{ route('settings.update') }}">
        @csrf
        @method('PUT')
        <div class="d-flex row">
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Bokningskalendern</span></div>
                    <div class="card-body">
                        <x-form-input type="color" model="{{ App\Helpers\Settings::class }}"
                            name="bookings_color_reserved" value="{{ settings('bookings_color_reserved') }}" />
                        <x-form-input type="color" model="{{ App\Helpers\Settings::class }}" name="bookings_color_own"
                            value="{{ settings('bookings_color_own') }}" />
                        <x-form-input type="color" model="{{ App\Helpers\Settings::class }}"
                            name="bookings_color_other" value="{{ settings('bookings_color_other') }}" />
                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Landningssidor</span></div>
                    <div class="card-body">
                        <x-form-select type="select" model="{{ App\Helpers\Settings::class }}" name="landing_start"
                            value="{{ settings('landing_start') }}" :options="$menus" />
                        <x-form-select type="select" model="{{ App\Helpers\Settings::class }}" name="landing_login"
                            value="{{ settings('landing_login') }}" :options="$menus" />
                        <x-form-select type="select" model="{{ App\Helpers\Settings::class }}" name="landing_logout"
                            value="{{ settings('landing_logout') }}" :options="$menus" />
                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Artikelnummer Medlemskap</span></div>
                    <div class="card-body">
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_membership_youth"
                            value="{{ settings('artno_membership_private') }}" />
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_membership_adult"
                            value="{{ settings('artno_membership_company') }}" />
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_membership_family"
                            value="{{ settings('artno_membership_family') }}" />
                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Artikelnummer Hyror</span></div>
                    <div class="card-body">
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_locker_small"
                            value="{{ settings('artno_locker_small') }}" />
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_locker_large"
                            value="{{ settings('artno_locker_large') }}" />
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_keycard"
                            value="{{ settings('artno_keycard') }}" />

                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Fortnox</span></div>
                    <div class="card-body">
                        @if (isset($settings['fortnox_error']) || !isset($settings['fortnox_refresh_token']))
                            Fortnox är felaktigt kopplat
                            @can('fortnox-connect')
                                <a href="{{ $fortnoxURL }}" class="btn btn-success">Koppla om Fortnox</a>
                            @endcan
                        @else
                            Fortnox är korrekt kopplat
                            @can('fortnox-connect')
                                <a href="{{ route('fortnox.destroy') }}" class="btn btn-danger">Koppla bort Fortnox</a>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-form-savebutton />
    </form>
</x-app-layout>
