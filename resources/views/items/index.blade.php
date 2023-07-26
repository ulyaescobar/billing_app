@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Items List</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add New Item</a>
    @if (count($items) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('items.show', ['item' => $item->id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('items.edit', ['item' => $item->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('items.destroy', ['item' => $item->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No items found.</p>
    @endif
</div>
@endsection
