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
                        <x-form-input type="color" model="{{ App\Helpers\Settings::class }}"
                            name="bookings_color_watches" value="{{ settings('bookings_color_watches') }}" />
                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Bokningsregler</span></div>
                    <div class="card-body">
                        <x-form-input type="integer" model="{{ App\Helpers\Settings::class }}"
                            name="bookings_rules_early_start"
                            value="{{ settings('bookings_rules_early_start', 15 * 60) }}" />
                        <x-form-input type="integer" model="{{ App\Helpers\Settings::class }}"
                            name="bookings_rules_late_end"
                            value="{{ settings('bookings_rules_late_end', 15 * 60) }}" />
                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Försäljning av medlemskap</span></div>
                    <div class="card-body">
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_membership_private"
                            value="{{ settings('artno_membership_private') }}" />
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_membership_company"
                            value="{{ settings('artno_membership_company') }}" />
                        <x-form-select :optionsBuilder="$articles" optionsBuilderField="article_number"
                            model="{{ App\Helpers\Settings::class }}" name="artno_membership_family"
                            value="{{ settings('artno_membership_family') }}" />
                        <x-form-input type="text" model="{{ App\Helpers\Settings::class }}"
                            name="stripe_price_private" value="{{ settings('stripe_price_private') }}" />
                        <x-form-input type="text" model="{{ App\Helpers\Settings::class }}"
                            name="stripe_price_company" value="{{ settings('stripe_price_company') }}" />
                        <x-form-input type="text" model="{{ App\Helpers\Settings::class }}"
                            name="stripe_price_family" value="{{ settings('stripe_price_family') }}" />
                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Medlemmar</span></div>
                    <div class="card-body">
                        <x-form-radio-inline model="{{ App\Helpers\Settings::class }}" name="members_buy_familymembers"
                            value="{{ settings('members_buy_familymembers') }}" :options="[1 => 'Ja', 0 => 'Nej']" />
                        <x-form-radio-inline model="{{ App\Helpers\Settings::class }}"
                            name="members_edit_familymembers" value="{{ settings('members_edit_familymembers') }}"
                            :options="[1 => 'Ja', 0 => 'Nej']" />
                        <x-form-radio-inline model="{{ App\Helpers\Settings::class }}" name="members_edit_familynames"
                            value="{{ settings('members_edit_familynames') }}" :options="[1 => 'Ja', 0 => 'Nej']" />
                        <x-form-radio-inline model="{{ App\Helpers\Settings::class }}" name="members_show_familynames"
                            value="{{ settings('members_show_familynames') }}" :options="[1 => 'Ja', 0 => 'Nej']" />
                    </div>
                </div>
            </div>
            {{-- <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Miljöparametrar</span></div>
                    <div class="card-body">
                        <x-form-input type="number" step="0.01" model="{{ App\Helpers\Settings::class }}"
                            name="environment_petrol_kwh" value="{{ settings('environment_petrol_kwh') }}" />
                        <x-form-input type="number" step="0.01" model="{{ App\Helpers\Settings::class }}"
                            name="environment_petrol_co2" value="{{ settings('environment_petrol_co2') }}" />
                        <x-form-input type="number" step="0.01" model="{{ App\Helpers\Settings::class }}"
                            name="environment_cng_kwh" value="{{ settings('environment_cng_kwh') }}" />
                        <x-form-input type="number" step="0.01" model="{{ App\Helpers\Settings::class }}"
                            name="environment_cng_co2" value="{{ settings('environment_cng_co2') }}" />
                        <x-form-input type="number" step="0.01" model="{{ App\Helpers\Settings::class }}"
                            name="environment_electricity_co2" value="{{ settings('environment_electricity_co2') }}" />
                    </div>
                </div>
            </div> --}}
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
