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
        // $foods = Food::join('food_ingredient', 'food_ingredient.food_id','=', 'food.id')
        //  ->join('ingredients','ingredient.id','=','food_ingredient.ingredient.id')
        //  ->where('ingredient.title', 'LIKE', '%' . $search . '%') ...
        if ($request->has('search')) {
            $rentals = Rental::join('products', 'products.id_produk', '=', 'rentals.id_produk')
                ->join('customers', 'customers.id_customer', '=', 'rentals.id_customer')
                ->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('camera', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {

            $rentals = Rental::orderByDesc('rentals.created_at')
                ->join('products', 'products.id_produk', '=', 'rentals.id_produk')
                ->join('customers', 'customers.id_customer', '=', 'rentals.id_customer')
                ->select('rentals.*', 'products.camera', 'customers.nama')
                ->paginate(10);
        }


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
        $check = Rental::count();
        if ($check == 0) {
            $id = 'R0001';
        } else {
            $getId = Rental::all()->last();
            $number = (int)substr($getId->id_rental, -1);
            $new_ide = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            $id = 'R' . $new_ide;
        };

        rental::create(['id_rental' => $id], $request->all());

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
