@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/sv.js"></script>
        <!-- Scripts for Calendar picker and date related JS -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js">
        </script>
    @endpush
    @push('stylesheets')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
@endonce
<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    <div class="input-group date">
        <input type="datetime-local" id="{{ $name }}" name="{{ $name }}"
            class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}"
            value="{{ substr(old($name, $value), 0, 14) }}00" placeholder="{{ $placeholder }}"
            {{ $required ?? false ? 'required' : '' }} {{ $disabled ?? false ? 'disabled' : '' }} {{ $attributes }}
            data-input>
        <div class="input-group-append" data-toggle>
            <div class="input-group-text"><x-bs-icon name="calendar-week" /></div>
        </div>
        <script>
            var {{ $name }} = flatpickr('#{{ $name }}', {
                locale: 'sv',
                dateFormat: 'Y-m-d H:i',
                timeFormat: 'H:i',
                minDate: '{{ substr($min, 0, 10) }}',
                maxDate: '{{ substr($max, 0, 10) }}',
                defaultDate: '{{ substr(old($name, $value), 0, 14) }}00',
                defaultHour: {{ substr(old($name, $value), 11, 2) }},
                defaultMinute: 0,
                minuteIncrement: 60,
                showMonths: 2,
                weekNumbers: true,
                allowInput: true,
                time_24hr: true,
                enableTime: true
            });
        </script>
    </div>
    @if ($errors->has($name))
        <small class="invalid-feedback d-block">{{ $errors->first($name) }}</small>
    @endif
</div>
