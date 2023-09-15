<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    @foreach ($options as $key => $item)
        <div class="form-check">
            <input type="checkbox" name="{{ $name }}@if($loop->count > 1)[]@endif"
                id="checkbox{{ $name }}-{{ $key }}" value="{{ $key }}" class="form-check-input{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}"
                @if(is_array($value) && array_key_exists($key, $value) && in_array(strtolower($value[$key]), [1, '1', 'on', 'true'])) checked @endif>
            <label for="checkbox{{ $name }}-{{ $key }}" class="form-check-label">{{ $item }}</label>
        </div>
    @endforeach
    @if ($errors->has($name))
    <small class="invalid-feedback">{{ $errors->first($name) }}</small>
@endif
</div>
