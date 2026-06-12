@extends('layout')

<div>
    File: <a href="{{ $filepath }}">{{ $filepath }}</a>
</div>
<div>
    Category: {{ $category }}
</div>
<div>
    Type: {{ $type }}
</div>
<div>
    Items:
    <ul>
    @foreach($items as $item => $value)
        @include('item', ['item' => $item, 'value' => $value])
    @endforeach
    </ul>
</div>
