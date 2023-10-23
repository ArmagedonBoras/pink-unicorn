<x-app-layout>
    <x-slot name="title">
        Nyheter
    </x-slot>
    @foreach ((array) $articles as $article)
        <h3>{{ $article->title }}</h3>
        <p>{!! $article->body !!}</p>
    @endforeach

</x-app-layout>
