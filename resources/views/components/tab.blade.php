@props(['name', 'icon', 'label'])

<div x-data="{
        id: '',
        name: '{{ $name }}',
        icon: '{{ $icon }}',
        label: '{{ $label ?? $name }}',
        show: false,
        showIfActive(active) {
            this.show = (this.name === active);
        }
    }"
     x-show="show"
     role="tabpanel"
     :aria-labelledby="`tab-${id}`"
     :id="`tab-panel-${id}`"
>
    {{ $slot }}
</div>