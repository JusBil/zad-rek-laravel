@extends('index')
@section('content')


@if ($errors->any())
    <div class="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('list_add') }}">
    @csrf 

    <div class="input-wrapper">
        <label>Dog name</label>
        <input 
            name="name" 
            type="text" 
            class="@error('name') is-invalid @enderror" 
            required
            placeholder="dog name"
            value="">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-wrapper">
        <label>Dog status</label>
        <select name="status">
            <option value="available" checked>available</option>
            <option value="pending">pending</option>
            <option value="sold">sold</option>
        </select>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <input class="btn add" type="submit" value="Add new dog">
</form>

<a class="btn" href="{{ route('list_show', ['status' => 'available']) }}">Back to list</a>

@endsection