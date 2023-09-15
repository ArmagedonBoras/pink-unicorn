<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    <textarea type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}"
        class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}
        {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @if ($errors->has($name))
        <small class="invalid-feedback">{{ $errors->first($name) }}</small>
    @endif
</div>
