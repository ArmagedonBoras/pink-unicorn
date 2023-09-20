<div class="form-group {{ $divClass }}">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <sup class="text-danger" title="Obligatoriskt fält">*</sup>
        @endif
    </label>
    <textarea id="summernote_{{ $name }}" name="{{ $name }}"></textarea>
    <script>
        $(document).ready(function() {
            $('#summernote_{{ $name }}').summernote({
                minHeight: 300,
                codeviewIframeFilter: false
            });
            $('#summernote_{{ $name }}').summernote('code', `{!! $value !!}`);
        });
    </script>
</div>
