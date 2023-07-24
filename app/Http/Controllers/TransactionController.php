<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Item;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Menampilkan halaman pembuatan transaksi
    public function create()
    {
        $items = Item::all();
        $customers = Customer::all();
        return view('transactions.create', compact('items', 'customers'));
    }

    // Memproses pembuatan transaksi
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'customer_id' => 'required',
            'items' => 'required|array',
            'items.*' => 'required|exists:items,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        // Buat transaksi baru
        $transaction = Transaction::create([
            'user_id' => Auth::id(), // User aktif adalah kasir yang menangani transaksi
            'customer_id' => $request->input('customer_id'),
        ]);

        // Simpan item-item yang dibeli dalam transaksi
        $items = $request->input('items');
        $quantities = $request->input('quantities');
        for ($i = 0; $i < count($items); $i++) {
            $item = Item::find($items[$i]);
            if ($item) {
                $transaction->transactionItems()->create([
                    'item_id' => $item->id,
                    'quantity' => $quantities[$i],
                    'price' => $item->price,
                ]);
            }
        }

        // Redirect ke halaman dengan pesan sukses
        return redirect()->route('transactions.show', $transaction->id)->with('success', 'Transaksi berhasil dibuat.');
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }
}

