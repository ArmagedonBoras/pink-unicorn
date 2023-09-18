<x-app-layout>
    <x-slot name="title">
        Skapa roll
    </x-slot>
    <form method="POST" action="{{ route('roles.store') }}">
@include('roles.form')
        </div>
    </form>
</x-app-layout>
