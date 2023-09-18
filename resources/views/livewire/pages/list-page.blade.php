<div>
    <table class="table">
        <thead>
            <th>Titel</th>
            <th>Sökväg</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($pages as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td><a href="{{ $item->menu->getLink() }}">{{ $item->menu->getLink() }}</a></td>
                    <td><a href="{{ route('pages.edit', $item->id) }}" class="btn btn-primary">Redigera</a>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
