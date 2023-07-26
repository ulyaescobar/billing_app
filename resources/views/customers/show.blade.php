@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $customer->name }}</h1>
    <a href="{{ route('customers.edit', ['customer' => $customer->id]) }}" class="btn btn-primary">Edit Customer</a>
    <form action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">Delete Customer</button>
    </form>
</div>
@endsection
