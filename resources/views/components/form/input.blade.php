<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    <input type="{{ $type ?? 'text' }}" id="{{ $name }}"  name="{{ $name }}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}"
        value="{{ old($name, $value) }}"  placeholder="{{ $placeholder }}" {{ !empty($step) ? 'step='.$step : '' }} {{ !empty($min) ? 'min='.$min : '' }}
        {{ !empty($max) ? 'max='.$max : '' }} {{ $required ?? false ? 'required' : '' }} {{ $disabled ?? false ? 'disabled' : '' }} {{ $attributes }}>
    @if($errors->has($name))
        <small class="invalid-feedback">{{ $errors->first($name) }}</small>
    @endif
</div>
