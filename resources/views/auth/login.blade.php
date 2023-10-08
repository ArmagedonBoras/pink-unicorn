<x-app-layout>
    <x-slot name="title">
        {{ __('Logga in') }}
    </x-slot>
    @env('local')
    <div class="row justify-content-center">
        <div class="col-1">
            <x-login-link email="orjan.almen@gmail.com" label="Örjan" />
        </div>
        <div class="col-1">
            <x-login-link email="niklas.mardby@gmail.com" label="Niklas" />
        </div>
    </div>
    @endenv

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row justify-content-center mb-4">
            <div class="col-10 col-md-6 col-lg-4">Här kan du som medlem logga in för att komma åt våra medlemssidor. Är
                du inte medlem så kan du
                <a href="{{ route('register') }}">bli medlem här</a>.
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-10 col-md-6 col-lg-4">
                <x-form-input name="email" label="Medlemsnummer eller E-postadress" />
                <x-form-input name="password" type="password" label="Lösenord" />
                <label>&nbsp;</label>
                <div class="form-group d-flex justify-content-between ">
                    <button type="submit" id="submitformbutton" class="btn btn-primary me-1">Logga in</button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Glömt lösenord?') }}
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </form>

    <div class="row justify-content-center mb-4">
        <div class="col-10 col-md-6 col-lg-4">
            Om du har konfigurerat din koppling kan du också logga in med något av dessa system:
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        @foreach (\App\Http\Controllers\OauthController::$providers as $provider => $icon)
            <a href="/login/{{ $provider }}" class="btn col"><x-icon>{{ $icon }}</x-icon></a>
        @endforeach
    </div>
</x-app-layout>
