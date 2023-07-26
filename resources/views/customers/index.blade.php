@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customers List</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add New Customer</a>
    @if (count($customers) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>
                            <a href="{{ route('customers.show', ['customer' => $customer->id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('customers.edit', ['customer' => $customer->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No customers found.</p>
    @endif
</div>
@endsection
