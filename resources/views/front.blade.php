<x-app-layout>
    <x-slot name="title">
        Armagedon
    </x-slot>
    <div class="row">
        <div class="col-10">
            @foreach ((array) $articles as $article)
                <h3>{{ $article->title }}</h3>
                <p>{!! $article->body !!}</p>
            @endforeach
        </div>
        <div class="col-2">
            @foreach ($links as $link)
                <x-bs-icon :name="$link->icon" />&nbsp;<a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a>
            @endforeach
        </div>
    </div>
</x-app-layout>
