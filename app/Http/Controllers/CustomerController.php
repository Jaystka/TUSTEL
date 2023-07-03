<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::orderBy('created_at', 'DESC')->get();

        return view('customer.index', compact('customer'));
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
        $customer = Customer::findOrFail($id_customer);

        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'customer deleted successfully');
    }
}
