<div>
    {{ $user->member_no }} {{ $user->name }}
    @foreach ($user->providers() as $key => $item)
        @if (is_string($item))
            <a href="{{ route('provider.redirectToProvider', ['provider' => $key]) }}" class="btn btn-primary col">Koppla
                inloggning till <x-bs-icon :name="$item" />&nbsp;{{ $key }} </a>
        @else
            <form method="POST" action="{{ route('provider.destroy', ['provider' => $key]) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger col">Koppla
                    bort inloggning till <x-bs-icon :name="$item->icon()" />&nbsp;{{ $key }}</button>
        @endif
    @endforeach
</div>
