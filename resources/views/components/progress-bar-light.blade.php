<div class="progress mb-4" style="height: 50px;">
    @foreach ($items as $item)
        <div class="progress-bar text-dark bg-white"
            style="width: {{ 100 / $loop->count }}%;" role="progressbar">
            <x-icon color="{{ $loop->iteration < $active ? 'green' : ($loop->iteration == $active ? $status : 'secondary') }}">
                {{ $loop->iteration < $active ? 'check-' : ($loop->iteration == $active ? 'play-' : '') }}circle</x-icon>{{ $item }}
        </div>
    @endforeach
</div>
