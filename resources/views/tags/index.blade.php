<x-app-layout>
    <x-slot name="title">
        Taggar
    </x-slot>
    <div class="d-flex justify-content-start">
        <div class="card-group">
            @foreach ($groupedTags as $module => $groups)
                <div class="card me-1">
                    <div class="card-header">
                        <div class="card-title">{{ Str::ucfirst($module) }}</div>
                    </div>
                    <div class="card-body">
                        <dl>
                            @foreach ($groups as $group => $tags)
                                <dt>{{ Str::ucfirst($group) }}&nbsp;<a
                                        href="{{ route('tags.create') }}?type={{ $module }}.{{ $group }}">
                                        <x-bs-icon name="plus-square" />&nbsp;
                                    </a>
                                </dt>
                                @foreach ($tags as $group => $tag)
                                    <dd>{{ $tag->label }}&nbsp;<a href="{{ route('tags.edit', $tag->id) }}">
                                            <x-bs-icon name="pencil-square" />
                                        </a></dd>
                                @endforeach
                            @endforeach
                        </dl>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
