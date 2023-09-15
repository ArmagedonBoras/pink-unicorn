<label for="{{ $name }}">
    {{ $label }}
    @if ($required)
        <sup class="text-danger" title="Obligatoriskt fält">*</sup>
    @endif
</label>
<div class="form-group {{ $divClass }}">
    @foreach ($options as $key => $item)
        <div class="form-check form-check-inline">
            <input type="checkbox" name="{{ $name }}[]" id="checkbox{{ $name }}-{{ $key }}" value="{{ $key }}"
            class="form-check-inline{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}"
            @if(is_array($value) && array_key_exists($key, $value) && in_array(strtolower($value[$key]), [1, '1', 'on', 'true'])) checked @endif>
            <label for="checkbox{{ $name }}-{{ $key }}" class="form-check-label">{{ $item }}</label>
        </div>
    @endforeach
    @if ($errors->has($name))
    <small class="invalid-feedback">{{ $errors->first($name) }}</small>
@endif
</div>