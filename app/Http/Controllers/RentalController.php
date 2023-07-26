<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index(Request $request)
    {

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
            $idR = 'R0001';
        } else {
            $getId = Rental::all()->last();
            $number = (int)substr($getId->id_rental, -4);
            $new_idR = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            $idR = 'R' . $new_idR;
        };

        rental::create(['id_rental' => $idR] + ['id_customer' => $request->id_customer]
            + ['id_produk' => $request->id_produk] + ['tanggal_sewa' => $request->tanggal_sewa]
            + ['jumlah' => $request->jumlah] + ['durasi' => $request->durasi] + ['status' => 0]);

        $check = Payment::count();
        if ($check == 0) {
            $idP = 'P0001';
        } else {
            $getidP = Payment::all()->last();
            $numberP = (int)substr($getidP->id_pembayaran, -4);
            $new_idP = str_pad($numberP + 1, 4, "0", STR_PAD_LEFT);
            $idP = 'P' . $new_idP;
        };

        $product = Product::Where('id_produk', $request->id_produk)->get('harga');
        $price = (int)$product->first()->harga;
        $total = $price * (int)$request->jumlah;
        payment::create(['id_pembayaran' => $idP] + ['id_rental' => $idR] + ['jenis' => $request->jenis] + ['total' => $total]);

        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('rental.index');
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
        $check = Payment::Where('id_rental', $id_rental)->count();
        if ($check > 0) {
            return response()->json([

                'error' => 'error'

            ]);
        } else {

            $rental = Rental::findOrFail($id_rental);
            $rental->delete();
            return response()->json(['success' => 'Post created successfully.']);
        }
    }

    public function print_pdf(Request $request)
    {

        if ($request->has('search')) {
            $rentals = Rental::join('products', 'products.id_produk', '=', 'rentals.id_produk')
                ->join('customers', 'customers.id_customer', '=', 'rentals.id_customer')
                ->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('camera', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            $rentals = Rental::orderByDesc('rentals.created_at')
                ->join('products', 'products.id_produk', '=', 'rentals.id_produk')
                ->join('customers', 'customers.id_customer', '=', 'rentals.id_customer')
                ->select('rentals.*', 'products.camera', 'customers.nama')
                ->get();
        }
        $time = Carbon::now('Asia/Jakarta');

        $pdf = PDF::loadview('rental.print', ['rentals' => $rentals], ['time' => $time]);
        return $pdf->stream();
    }
}
