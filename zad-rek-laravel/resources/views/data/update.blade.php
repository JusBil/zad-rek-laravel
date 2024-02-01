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

<form method="POST" action="{{ route('list_update', ['id' => $id]) }}">
    @method('PUT')
    @csrf 

    <div class="input-wrapper">
        <label>Dog name</label>
        <input 
            name="name" 
            type="text" 
            class="@error('name') is-invalid @enderror" 
            required
            placeholder="dog name"
            value="{{ $dog['name'] }}">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-wrapper">
        <label>Dog status</label>
        <select name="status">
            <option value="available" @if ($dog['status'] === 'available') ? checked : '' @endif>available</option>
            <option value="pending" @if ($dog['status'] === 'pending') ? checked : '' @endif>pending</option>
            <option value="sold" @if ($dog['status'] === 'sold') ? checked : '' @endif>sold</option>
        </select>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <input class="btn edit" type="submit" value="Edit dog data">
</form>

<a class="btn "href="{{ route('list_show', ['status' => 'available']) }}">Back to list</a>

@endsection