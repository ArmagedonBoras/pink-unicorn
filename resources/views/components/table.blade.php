<table class="table table-striped js-sort-table">
    <thead>
        <tr>
            @foreach ($fields as $field => $column)
                <th scope="col" @if (isset($column['class'])) class="{{ $column['class'] }}" @endif
                    @if (isset($column['style'])) style="{{ $column['style'] }}" @endif>{{ $column['title'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
            <tr @if (isset($item['row_class'])) class="{{ $item['row_class'] }}" @endif>
                @foreach ($fields as $field => $column)
                    @if (isset($item[$field . '_link']))
                        <td @if (isset($item[$field . '_cellclass'])) class="{{ $item[$field . '_cellclass'] }}" @endif>
                            <a href="{{ $item[$field . '_link'] }}"
                                @if (isset($item[$field . '_linkclass'])) class="{{ $item[$field . '_linkclass'] }}" @endif>{!! $item[$field] !!}</a>
                        </td>
                    @else
                        <td @if (isset($item[$field . '_cellclass'])) class="{{ $item[$field . '_cellclass'] }}" @endif>
                            {!! $item[$field] !!}
                        </td>
                    @endif
                @endforeach
            </tr>
        @empty
            <td colspan="{{ count($fields) }}">Just nu finns det inga poster att visa</td>
        @endforelse
    </tbody>
</table>
