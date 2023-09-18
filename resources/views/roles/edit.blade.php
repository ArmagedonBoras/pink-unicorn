<x-app-layout>
    <x-slot name="title">
        Redigera roll
    </x-slot>
    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @method('PUT')
        <x-form-readonly :model="$role" name="name" />
        <x-form-input :model="$role" name="label" />
        @if(in_array($role->name, ['admin', 'guest', 'user'] ))
            <x-form-savebutton />
            @else
            <x-form-savebutton delete="" />
            <x-form-delete-form route="{{ route('roles.destroy', $role->id) }}" />
        @endif
    </form>

Lägg till medlem

    <form method="POST" action="{{ route('rolemembers.store', [$role->id]) }}">
        @csrf
        <x-form-select :model="$role" name="user_id" :options-builder="$users"  />
        <x-form-savebutton submit="Lägg till" />
    </form>



Nuvarande rollmedlemmar

    <table>
    @foreach ($role->users->sortBy('id') as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>
                <x-form-savebutton submit=false delete="Ta bort" />
                <x-form-delete-form route="{{ route('rolemembers.destroy', [$role->id, $user->id]) }}" />
            </td>
        </tr>
    @endforeach
</table>
</x-app-layout>
