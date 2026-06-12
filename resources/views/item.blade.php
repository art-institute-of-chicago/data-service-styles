<li>
    @if($item)
        {{ $item }}
    @endif
    @if(is_array($value))
        <ul>
        @foreach($value as $subitem => $subitemValue)
            @if($subitem == '$comment')
                <!-- Do not show comments -->
            @elseif($subitem == '$value')
                @include('item', ['item' => null, 'value' => $subitemValue])
            @else
                @include('item', ['item' => $subitem, 'value' => $subitemValue])
            @endif
        @endforeach
        </ul>
    @else
        <b>{{ $value }}</b>
    @endif
</li>
