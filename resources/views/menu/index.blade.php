<x-app-layout>
    <x-slot name="size">
        100
    </x-slot>
    <x-slot name="title">
        Menyer
    </x-slot>
    <x-table :fields="['name', 'icon', 'link', 'gate', 'sort_order', 'parent', 'page_id']" model="App\Models\Menu" :items="$menus" translate="fields" />

</x-app-layout>
