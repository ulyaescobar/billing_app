@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Transactions</h1>

    <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Create Transaction</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Customer Name</th>
                <th>Admin Name</th>
                <th>Items Purchased</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->customer->name }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>
                        <ul>
                            @foreach ($transaction->transactionItems as $item)
                                <li>{{ $item->item->name }} (Qty: {{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
