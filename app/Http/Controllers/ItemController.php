<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validates = $request->validate([
            'name' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'price' => 'required|integer|min:0'
        ]);

        Item::create($validates);

        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    public function edit(Item $item)
    {
        return view('items.update', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validates = $request->validate([
            'name' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'price' => 'required|integer|min:0'
        ]);

        $item->update($validates);
        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted succesfully!');
    }
}
