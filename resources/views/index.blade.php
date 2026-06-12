@extends('layout')

@section('content')
    @include('tree', ['tree' => $tree])
@endsection
