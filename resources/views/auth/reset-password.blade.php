<x-app-layout>
    <x-slot name="title">
        Återställ lösenord
    </x-slot>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-4">
                <x-form-input name="email" label="E-postadress" value="{{ $request->email }}" />
                <x-form-input name="password" type="password" label="Lösenord" />
                <x-form-input name="password_confirmation" type="password" label="Bekräfta Lösenord" />
                <label>&nbsp;</label>
                <div class="form-group d-flex justify-content-between ">
                    <button type="submit" id="submitformbutton" class="btn btn-primary me-1">Återställ
                        lösenordet</button>


                </div>
            </div>
        </div>
    </form>
</x-app-layout>
