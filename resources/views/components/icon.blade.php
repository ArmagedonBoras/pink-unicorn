<i class="bi-{{ $slot }} {{ $class ?? '' }}" @isset($title)title="{{ $title ?? ''}}"@endisset style="font-size: {{ $size ?? 16 }}px; @isset($color)color: {{ $color ?? '' }};@endisset"></i>
