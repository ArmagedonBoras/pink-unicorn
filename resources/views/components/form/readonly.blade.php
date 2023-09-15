@if ($inline > 0)
    <div class="d-flex justify-content-between my-3 ml-0 {{ $divClass }}">
        <div class="col-{{ $inline }} pl-0">
            <label>{{ $label }}</label>
        </div>
        <span class="col {{ $inputClass }}"  id="{{ $name }}">{{ $value }}</span>
         <span class="col text-right pr-0">{{ $comment }}</span>
    </div>
@else
    <label class="ml-1 pl-0">{{ $label }}</label>
    <div class="d-flex justify-content-between m-1 pl-0 mb-2 {{ $divClass }}">
        <span class="{{ $inputClass }}" id="{{ $name }}">{{ $value }}</span>
        <span class="pr-0">{{ $comment }}</span>
    </div>
@endif
