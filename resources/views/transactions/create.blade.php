@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buat Transaksi') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="customer_id">Pilih Customer:</label>
                            <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                <option value="">Pilih Customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="items">Pilih Item dan Jumlah:</label>
                            @foreach ($items as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="items[]" value="{{ $item->id }}" id="item_{{ $item->id }}">
                                <label class="form-check-label" for="item_{{ $item->id }}">
                                    {{ $item->name }} (Stok: {{ $item->stok }}) - Harga: {{ $item->price }}
                                </label>
                                <input type="number" name="quantities[]" class="form-control" min="1" value="1">
                            </div>
                            @endforeach
                            @error('items')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            @error('quantities')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Buat Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
