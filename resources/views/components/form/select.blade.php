<div class="form-group {{ $divClass ?? '' }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-select{{ $errors->has($name) ? ' is-invalid' : '' }} {{ $inputClass }}" {{ $required ?? false ? 'required' : '' }} {{ $disabled ?? false ? 'disabled' : '' }} {{ $attributes }}>
        @foreach ((array)$options as $key => $tag)
            @if (is_array($tag))
                <optgroup label="{{ $key }}"></optgroup>
                @foreach ((array)$tag as $itemkey => $item)
                    <option value="{{ $itemkey }}" {{ old($name, $value) == $itemkey ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            @else
                <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>{{ $tag }}</option>
            @endif
        @endforeach
    </select>
    @if($errors->has($name))
        <small class="invalid-feedback">{{ $errors->first($name) }}</small>
    @endif
</div>
