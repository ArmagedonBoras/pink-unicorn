<x-app-layout>
    <x-slot name="title">
        Redigera Tagg/listpost
    </x-slot>
    <form method="POST" action="{{ route('tags.update', $tag->id) }}" id="edit-form">
        @method('PUT')
        @csrf
        @if($tag->protected)
            <x-form-readonly :model="$tag" name="name" />
            <x-form-input :model="$tag" name="label" />
            <x-form-readonly :model="$tag" name="type" :options="$types" />
            <x-form-savebutton />
        @else
            <x-form-input :model="$tag" name="name" />
            <x-form-input :model="$tag" name="label" />
            <x-form-select :model="$tag" name="type" :options="$types" />
            <x-form-savebutton delete="" />
        @endif

    </form>
    <x-form-delete-form route="{{ route('tags.destroy', $tag->id) }}" />
</x-app-layout>
