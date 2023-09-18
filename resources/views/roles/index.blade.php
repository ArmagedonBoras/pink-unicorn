<x-app-layout>
    <x-slot name="title">
        Roller
    </x-slot>
<dl>
    @foreach ($roles as $role)
<dd>{{ $role->label }}&nbsp;<a href="{{ route('roles.edit', $role->id) }}"><x-icon>pencil-square</x-icon></a></dd>
    @endforeach
</dl>

Skapa ny roll



<form method="POST" action="{{ route('roles.store') }}">
    @csrf
    <div class="form-group">
        <label for="label">Visningsnamn</label>
        <input type="text" id="label" name="label" value="{{ old('label') }}" class="form-control">
    </div>
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Spara</button>
    </div>
</form>
</x-app-layout>
