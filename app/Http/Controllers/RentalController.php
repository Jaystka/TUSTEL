<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $rentals = Rental::orderByDesc('rentals.created_at')
            ->join('products', 'products.id_produk', '=', 'rentals.id_produk')
            ->join('customers', 'customers.id_customer', '=', 'rentals.id_customer')
            ->select('rentals.*', 'products.camera', 'customers.nama')
            ->paginate(10);

        return view('rental.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rentals = Product::get();
        $customers = Customer::get();

        return view('rental.create', compact('rentals', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        rental::create($request->all());

        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('rental.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_rental)
    {
        $rental = Rental::findOrFail($id_rental);

        return view('rental.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_rental)
    {
        $rental = Rental::findOrFail($id_rental);
        $customers = Customer::where('id_customer', $rental->id_customer)->get();
        $products = Product::get();

        return view('rental.edit', compact('rental', 'products', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_rental)
    {
        $rental = Rental::findOrFail($id_rental);

        $rental->update($request->all());

        Alert::success('Rental berhasil diperbarui')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('rental.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_rental)
    {
        $rental = Rental::findOrFail($id_rental);

        $rental->delete();

        return redirect()->route('rental.index')->with('success', 'rental deleted successfully');
    }
}
