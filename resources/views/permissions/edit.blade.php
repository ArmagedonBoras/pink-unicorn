<x-app-layout>
    <x-slot name="title">
        Redigera rättighet
    </x-slot>

    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
        @method('PUT')
        @csrf
        <x-form-readonly :model="$permission" name="name" />
        <x-form-input :model="$permission" name="label" />
        <x-form-input :model="$permission" name="group" />
        <x-form-savebutton />
    </form>
</x-app-layout>
