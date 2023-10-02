<x-app-layout>
    <form action="{{ empty($event->id) ? route('events.store') : route('events.update', $event) }}" method="POST">
        @csrf
        @if (!empty($event->id))
            @method('PUT')
        @endif
        <x-booking-date-hour-picker name="starts_at" :model="$event" :min="$min" :max="$max"
            :value="$default" />
        <x-booking-date-hour-picker name="ends_at" :model="$event" :min="$min" :max="$max" />
        <x-form-input name="title" :model="$event" />
        <x-form-editor name="body" :model="$event" />
        @can('book-several-rooms')
            <x-form-checkbox-inline name="room" :model="$event" :options="$event->available_rooms()" />
        @else
            <x-form-radio-inline name="room" :model="$event" :options="$event->available_rooms()" />
        @endcan
        <x-form-savebutton submit="{{ empty($event->id) ? 'Skapa' : 'Spara' }}" />
        {{--
        <x-form-input name="title_color" :model="$event" type="color" />
        <x-form-input name="tagline" :model="$event" />
        <x-form-input name="tagline_color" :model="$event" type="color" />
        <x-form-editor name="body" :model="$event" />
        <x-form-select name="title_image" :model="$event" :options="$images" />
        <x-form-input name="title_size" :model="$event" type="number" />
        <x-form-input name="name" :model="$menu" />
        <x-form-select name="gate" :model="$menu" :options="$menu->gate_options" />
        <x-form-select name="parent" :model="$menu" :options="$menu->parent_options" />
        <x-form-input name="link" :model="$menu" />
        <x-form-radio-inline name="active" :model="$event" :options="$event->active_options" />
        <x-form-savebutton submit="{{ empty($event->id) ? 'Skapa' : 'Spara' }}" /> --}}
    </form>
</x-app-layout>
