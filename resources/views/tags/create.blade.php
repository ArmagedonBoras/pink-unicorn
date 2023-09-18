<x-app-layout>
    <x-slot name="title">
        Ny Tagg/listpost
    </x-slot>
    <form method="POST" action="{{ route('tags.store') }}">
        @csrf
        <x-form-input model="{{ App\Models\Tag::class }}" name="name" />
        <x-form-input model="{{ App\Models\Tag::class }}" name="label" />
        <x-form-select model="{{ App\Models\Tag::class }}" name="type" :options="$types" :value="$preselected" />
        <x-form-savebutton />
    </form>
</x-app-layout>
