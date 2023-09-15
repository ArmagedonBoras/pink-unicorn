<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-select{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}" {{ $required ?? false ? 'required' : '' }} {{ $disabled ?? false ? 'disabled' : '' }} {{ $attributes }}>
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" {{ old($name, $value) == $tag->id ? 'selected' : '' }} data-name="{{ $tag->name }}">{{ $tag->label }}</option>
        @endforeach
    </select>
    @if ($errors->has($name))
    <small class="invalid-feedback">{{ $errors->first($name) }}</small>
    @endif
</div>
