<div class="row mx-0">
    <div role="alert" class="alert alert-dismissible fade show col-12 alert-{{ $type }}">
        @if(!empty($icon)) <x-icon>{{ $icon }}</x-icon> @endif
        {{ $slot }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Stäng">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
