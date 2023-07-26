<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Test\TestStatus\Success;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validates = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        Customer::create($validates);

        return redirect()->route('customers.index')->with('success', 'customer created succesfully!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.update', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validates = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $customer->update($validates);
        return redirect()->route('customers.index')->with('success', 'customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'customer deleted successfully!');
    }
}
