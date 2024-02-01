@extends('index')
@section('content')

<p class="error">api error</p>
<p class="error">{{ $error }}</p>

<a class="btn" href="{{ route('list_show') }}">Back to list</a>

@endsection