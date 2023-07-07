<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        customer::create($request->all());

        return redirect()->route('customer.index')->with('success', 'customer added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_customer)
    {
        $customers = Customer::findOrFail($id_customer);

        return view('customer.show', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_customer)
    {
        $customers = Customer::findOrFail($id_customer);

        return view('customer.edit', compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_customer)
    {
        $customers = Customer::findOrFail($id_customer);

        $customers->update($request->all());

        return redirect()->route('customer.index')->with('success', 'customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        $customers = Customer::findOrFail($id_customer);

        $customers->delete();

        return redirect()->route('customer.index')->with('success', 'customer deleted successfully');
    }
}
