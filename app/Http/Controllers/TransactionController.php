<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Item;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index(){
        $transactions = Transaction::with('customer', 'user', 'transactionItems.item')->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        // Ambil data customer untuk ditampilkan di form transaksi
        $customers = Customer::all();

        // Ambil data item untuk ditampilkan di form transaksi
        $items = Item::all();

        return view('transactions.create', compact('customers', 'items'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form transaksi
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Ambil user yang sedang login saat ini
        $user = Auth::user();

        // Buat transaksi baru
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'customer_id' => $request->input('customer_id'),
        ]);

        // Ambil data item dan quantity dari request
        $itemsData = $request->input('items');

        // Simpan setiap item yang ditransaksikan dalam tabel transaction_items
        foreach ($itemsData as $itemData) {
            $item = Item::find($itemData['item_id']);
            if ($item) {
                // Simpan detail item dalam transaksi
                $transaction->transactionItems()->create([
                    'item_id' => $item->id,
                    'quantity' => $itemData['quantity'],
                ]);

                // Kurangi stok item
                $item->stok -= $itemData['quantity'];
                $item->save();
            }
        }

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }
}

