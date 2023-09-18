        @csrf
        <div class="form-group">
            <input type="text" name="name" value="{{ old('name', $tag->name ?? '') }}" class="form-control"
                placeholder="Visningsnamn">
        </div>
        <div class="form-group">
            <select name="type" class="form-select">
                @foreach ($types as $module => $types)
                    <optgroup label="{{ Str::ucfirst($module) }}"></optgroup>
                    @foreach ($types as $type)
                        <option value="{{ $module }}.{{ $type }}"
                            @if (old('type', $tag->type ?? '') == $module . '.' . $type ||
                                    ($preselected['module'] == $module && $preselected['type'] == $type)) selected="selected" @endif>{{ Str::ucfirst($type) }}
                        </option>
                    @endforeach
                @endforeach
            </select>
            @error('type')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group d-flex justify-content-start">
            <button type="submit" class="btn btn-primary me-1">Spara</button>
