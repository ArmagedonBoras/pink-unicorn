<x-app-layout>
    <x-slot name="title">
        Glömt lösenord?
    </x-slot>
    <form method="POST" action="{{ route('password.request') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="mb-3">
                    Glömt ditt lösenord? Ange din epostadress nedan så skickar vi en återställningslänk så kan du byta
                    till ett nytt lösenord.
                </div>
                <x-form-input name="email" label="E-postadress" />
                <label>&nbsp;</label>
                <div class="form-group d-flex justify-content-between ">
                    <button type="submit" id="submitformbutton" class="btn btn-primary me-1">Skicka
                        återställningslänk</button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Glömt lösenord?') }}
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </form>
</x-app-layout>
