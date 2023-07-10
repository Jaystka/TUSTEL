<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $customers = Customer::where('nama', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        }

        return view('customer.index', compact('customers'));
    }

    // public function index(Request $request)
    // {
    //     if ($request->has('search')) {
    //         $products = Product::where('camera', 'like', '%' . $request->search . '%')->paginate(10);
    //     } else {
    //         $products = Product::orderBy('created_at', 'DESC')->paginate(10);
    //     }

    //     return view('product.index', compact('products'));
    // }

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

        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('customer.index');
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

        Alert::success('Customer berhasil diperbarui')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        $customers = Customer::findOrFail($id_customer);

        $customers->delete();

        return response()->json(['success' => 'Post created successfully.']);
    }
}
