<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    <textarea id="summernote" name="{{ $name }}"></textarea>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                minHeight: 300
            });
            $('#summernote').summernote('code', `{!! $value !!}`);
        });
    </script>
</div>
