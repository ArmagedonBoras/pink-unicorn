<x-app-layout>
    <x-slot name="title">
        Medlemmar
    </x-slot>
    <x-table :fields="['name', 'profile', 'email', 'status', 'login_at', 'previous_login_at']" model="App\Models\User" :items="$users" translate="fields" :sorting="['login_at' => 'date', 'previous_login_at' => 'date']" />

</x-app-layout>
