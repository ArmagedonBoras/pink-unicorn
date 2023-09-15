<x-app-layout>
    <x-slot name="title">
        Sidor
    </x-slot>
    <a href="{{ route('pages.create') }}" class="btn btn-primary">Skapa sida</a>
    <x-table :items="$pages" :fields="$fields" model="Page" translate="fields" />
</x-app-layout>
