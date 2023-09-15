<div class="progress mb-4" style="height: 50px;">
    @foreach ($items as $item)
        <div class="progress-bar bg-{{ $loop->iteration < $active ? 'success' : ($loop->iteration == $active ? $status : 'secondary') }} text-white font-weight-bold"
            style="width: {{ 100 / $loop->count }}%;" role="progressbar">
            <x-icon>{{ $loop->iteration }}-circle</x-icon>{{ $item }}
        </div>
    @endforeach
</div>
