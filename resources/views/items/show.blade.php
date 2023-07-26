@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $item->name }}</h1>
    <p>Stock: {{ $item->stok }}</p>
    <p>Price: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
    <a href="{{ route('items.edit', ['item' => $item->id]) }}" class="btn btn-primary">Edit Item</a>
    <form action="{{ route('items.destroy', ['item' => $item->id]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete Item</button>
    </form>
</div>
@endsection
