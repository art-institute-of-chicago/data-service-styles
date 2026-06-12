<ul>
@foreach($tree as $edge => $node)
    <li>
        @if(is_array($node))
            {{ $edge }}
            @include('tree', ['tree' => $node])
        @else
            <a href="{{ $node->href }}">{{ $node->label }}</a>
        @endif
    </li>
@endforeach
</ul>
