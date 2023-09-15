<x-app-layout>
    <x-slot name="title">
        {{ empty($page->id) ? 'Skapa' : 'Redigera' }} Sida
    </x-slot>
    <form action="{{ empty($page->id) ? route('pages.store') : route('pages.update', $page) }}" method="POST">
        @csrf
        @if (!empty($page->id))
            @method('PUT')
        @endif
        <x-form-input name="title" :model="$page" />
        <x-form-input name="title_color" :model="$page" type="color" />
        <x-form-input name="tagline" :model="$page" />
        <x-form-input name="tagline_color" :model="$page" type="color" />
        <x-form-editor name="body" :model="$page" />
        <x-form-select name="title_image" :model="$page" :options="$images" />
        <x-form-input name="title_size" :model="$page" type="number" />
        <x-form-input name="name" :model="$menu" />
        <x-form-select name="gate" :model="$menu" :options="$menu->gate_options" />
        <x-form-select name="parent" :model="$menu" :options="$menu->parent_options" />
        <x-form-input name="link" :model="$menu" />
        <x-form-radio-inline name="active" :model="$page" :options="$page->active_options" />
        <x-form-savebutton submit="{{ empty($page->id) ? 'Skapa' : 'Spara' }}" />
    </form>
</x-app-layout>
