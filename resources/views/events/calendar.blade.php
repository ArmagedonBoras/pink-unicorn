<x-app-layout>
    <x-slot name="image">
        {{ $title_image ?? '' }}
    </x-slot>
    <x-slot name="size">
        100
    </x-slot>
    <x-slot name="title">
        Kalender
    </x-slot>
    <x-slot name="title_color">
        {{ $title_color ?? '' }}
    </x-slot>
    <x-slot name="tagline">
        {{ $tagline ?? '' }}
    </x-slot>
    <x-slot name="tagline_color">
        {{ $tagline_color ?? '' }}
    </x-slot>
    <livewire:calendar room="2">
</x-app-layout>
