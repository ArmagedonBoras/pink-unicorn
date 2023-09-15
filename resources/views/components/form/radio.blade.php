<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    @foreach ($options as $key => $item)
        <div class="form-check">
            <input type="radio" name="{{ $name }}" id="radio{{ $name }}-{{ $key }}" value="{{ $key }}" class="form-check-input{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}" {{ $key == $value ? 'checked': '' }}>
            <label for="radio{{ $name }}-{{ $key }}" class="form-check-label">{{ $item }}</label>
        </div>
    @endforeach
    @if ($errors->has($name))
    <small class="invalid-feedback">{{ $errors->first($name) }}</small>
@endif
</div>