@extends('index')
@section('content')

@if (session('success'))
    <ul>
        <li>{{session('success')}}</li>
    </ul>
@endif

<a class="add btn" href="{{ route('list_add') }}">Add new dog</a>

<div class="filters">
    <p>Sort by status:</p>
    <a class="{{ (Request::getRequestUri() == '/available') ? 'checked' : ''  }}" href="{{ route('list_show', ['status' => 'available']) }}">available</a>
    <a class="{{ (Request::getRequestUri() == '/pending') ? 'checked' : ''  }}" href="{{ route('list_show', ['status' => 'pending']) }}">pending</a>
    <a class="{{ (Request::getRequestUri() == '/pending') ? 'sold' : ''  }}" href="{{ route('list_show', ['status' => 'sold']) }}">sold</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>dog name</th>
            <th>status</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $dog)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ ( isset($dog['name']) ) ? $dog['name'] : '-' }}</td>
            <td class="{{ $dog['status'] }}">{{ $dog['status'] }}</td>
            <td class="action">
                <a class="btn" href="{{ route('list_update_form', [ 'id' => $dog['id'] ]) }}">Edit dog</a>
                <form method="POST" action="{{ route('list_delete', [ 'id' => $dog['id'] ]) }}">
                    @method('DELETE')
                    @csrf 
                    <input class="delete btn" type="submit" value="Delete dog ">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection