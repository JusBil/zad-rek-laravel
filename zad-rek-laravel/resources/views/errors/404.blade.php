@extends('index')
@section('content')

<h2 class="not-found">404 not found</h2>

<a class="btn "href="{{ route('list_show', ['status' => 'available']) }}">Back to list</a>

@endsection