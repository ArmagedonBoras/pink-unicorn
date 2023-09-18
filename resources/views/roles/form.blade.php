    @csrf
    <div class="form-group">
        <label for="label">Systemnamn</label>
        <input type="text" id="name" name="name" value="{{ old('name', $role->name ?? '') }}"
            class="form-control">
    </div>
    <div class="form-group">
        <label for="label">Visningsnamn</label>
        <input type="text" id="label" name="label" value="{{ old('label', $role->label ?? '') }}"
            class="form-control">
    </div>
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary me-1">Spara</button>
