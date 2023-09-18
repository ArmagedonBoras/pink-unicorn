<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="form-group col-6">
                <label for="title" class="form-label mt-2">
                    {{ __('page.label-title') }} <span class="text-danger" title="Obligatoriskt fält">*</span>
                </label>
                <input wire:model="page.title" type="text" id="title"  name="title" class="form-control"  placeholder="{{ __('page.placeholder-title') }}">
                @error('page.title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-6">
                <label for="tagline" class="form-label mt-2">
                    {{ __('page.label-tagline') }}
                </label>
                <input wire:model="page.tagline" type="text" id="tagline"  name="tagline" class="form-control"  placeholder="{{ __('page.placeholder-tagline') }}">
                @error('page.tagline') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="title_image" class="form-label mt-2">
                    {{ __('page.label-title_image') }}
                </label>
                <div class="input-group">
                        <button class="btn dropdown-toggle btn-outline-secondary input-group-text" type="button" id="dropdownSelectImage" data-bs-toggle="dropdown" aria-expanded="false">
                        Välj titelbakgrund
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownSelectImage">
                            <li><a class="dropdown-item" href="#" wire:click="selectImage('')">Ingen bild</a></li>
                            @foreach ($images as $image)
                                <li><a class="dropdown-item" href="#" wire:click="selectImage('{{ $image }}')"><img src="{{ asset($image) }}" height="30px">&nbsp;{{ substr($image, 7) }}</a></li>
                            @endforeach
                        </ul>
                    <div class="ml-4 input-group-text">
                        {{ empty($page->title_image) ? 'Ingen bild vald' :  substr($page->title_image, 7) }}
                    </div>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="title_size" class="form-label mt-2">
                    {{ __('page.label-title_size') }} <span class="text-danger" title="Obligatoriskt fält">*</span>
                </label>
                <select wire:model="page.title_size" class="form-select">
                    @foreach (range(1,5) as $i)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="name" class="form-label mt-2">
                    {{ __('menu.label-name') }} <span class="text-danger" title="Obligatoriskt fält">*</span>
                </label>
                <input wire:model="menu.name" type="text" id="name"  name="name" class="form-control"  placeholder="{{ __('menu.placeholder-name') }}">
                @error('menu.name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-6">
                <label for="gate" class="form-label mt-2">
                    {{ __('menu.label-gate') }} <span class="text-danger" title="Obligatoriskt fält">*</span>
                </label>
                <select wire:model="menu.gate" type="text" id="gate"  name="gate" class="form-select">
                    <option value="">Synlig för alla</option>
                    <optgroup label="Rättigheter">
                        @foreach ($gates as $name => $label)
                            <option value="{{ $name }}">{{ $label }} ({{ $name }})</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Roller">
                        @foreach ($roles as $name => $label)
                            <option value="{{ $name }}">{{ $label }} ({{ $name }})</option>
                        @endforeach
                    </optgroup>
                </select>
                @error('menu.gate') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-4">
                <label for="parent" class="form-label mt-2">
                    {{ __('menu.label-parent') }} <span class="text-danger" title="Obligatoriskt fält">*</span>
                </label>
                <select wire:model="menu.parent" type="text" id="parent"  name="parent" class="form-select">
                    <option value="">Ingen överstående länk</option>
                        @foreach ($parents as $i)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endforeach
                </select>
                @error('menu.parent') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-4">
                <label for="link" class="form-label mt-2">
                    {{ __('menu.label-link') }} <span class="text-danger" title="Obligatoriskt fält">*</span>
                </label>
                <input wire:model="menu.link" type="text" id="link"  name="link" class="form-control"  placeholder="{{ __('menu.placeholder-link') }}">
                @error('menu.link') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-4">
                <label for="full_link" class="form-label mt-2">
                    Komplett länk
                </label>
                <input disabled value="{{ $menu->getLink() }}" name="full_link" class="form-control">

            </div>
        </div>
        <div class="form-group">
            <label for="active" class="form-label mt-2">
                Publicerad
            </label>
            <input type="checkbox" wire:model="page.active">
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label for="body" class="form-label mt-2">
                    {{ __('page.label-body') }} <span class="text-danger" title="Obligatoriskt fält">*</span>
                </label>
                <span>Kan innehålla html-taggar</span>
            </div>
            <textarea wire:model="page.body" type="text" id="body"  name="body" class="form-control"  rows="20" placeholder="{{ __('page.placeholder-body') }}"></textarea>
            @error('page.body') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Spara</button> <button type="reset" class="btn btn-primary mt-2">Återställ</button> @if($page->isDirty()) Du har osparade ändringar. @else

        @endif
    </form>

    <h2 class="mt-3">Förhandsgranskning</h2>

    <div class="container p-0 bg-white">
        <div class="m-0 p-{{ $page->title_size ?? 2 }}" @if($page->title_image ?? '' !== "") style="background-image: url('{{ asset($page->title_image) }}'); background-size: auto; background-repeat: no-repeat" @endif>
            <span class="row justify-content-center fs-2 fw-bold">{{ $page->title ?? '' }}</span>
            <span class="row justify-content-center fs-5 fw-normal">{{ $page->tagline ?? '' }}</span>
        </div>
    </div>
    {!! $page->body !!}
</div>
