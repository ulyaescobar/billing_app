@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Transaksi') }}</div>

                <div class="card-body">
                    <p><strong>Customer:</strong> {{ $transaction->customer->name }}</p>
                    <p><strong>Kasir:</strong> {{ $transaction->user->name }}</p>
                    <p><strong>Daftar Item:</strong></p>
                    <ul>
                        @foreach ($transaction->transactionItems as $transactionItem)
                        <li>{{ $transactionItem->item->name }} (Harga: {{ $transactionItem->Item->price }}, Jumlah: {{ $transactionItem->quantity }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
