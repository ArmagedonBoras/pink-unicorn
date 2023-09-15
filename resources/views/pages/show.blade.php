<x-app-layout>
    <x-slot name="image">
        {{ $page->title_image }}
    </x-slot>
    <x-slot name="size">
        {{ $page->title_size }}
    </x-slot>
    <x-slot name="title">
        {{ $page->title }}
        @can('pages-update')
            <a href="{{ route('pages.edit', $page) }}" title="Redigera sida">
                <x-icon>pencil-square</x-icon>
            </a>
        @endcan
    </x-slot>
    <x-slot name="title_color">
        {{ $page->title_color }}
    </x-slot>
    <x-slot name="tagline">
        {{ $page->tagline }}
    </x-slot>
    <x-slot name="tagline_color">
        {{ $page->tagline_color }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8">
            {!! $page->body !!}
        </div>
    </div>
</x-app-layout>
