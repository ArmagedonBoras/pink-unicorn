<label>&nbsp;{{ $label ?? '' }}</label>
<div class="form-group d-flex justify-content-start {{ $divClass }}">
    @if ($submit === true)
        <button type="submit" id="submitformbutton" class="btn btn-primary me-1">{{ $submitText }}</button>
    @endif
    @if ($reset === true)
        <button type="reset" id="resetfrombutton" class="btn btn-primary me-1">{{ $resetText }}</button>
    @endif
    @if ($delete === true)
        <button type="button" id="deleteformbutton" class="btn btn-danger"
            onclick="document.getElementById('delete-form').submit()">{{ $deleteText }}</button>
    @endif
</div>
