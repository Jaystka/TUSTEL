<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rental;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $products = Product::where('camera', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        }

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = Product::count();
        if ($check == 0) {
            $id = 'PR001';
        } else {
            $getId = Product::all()->last();
            $number = (int)substr($getId->id_produk, -3);
            $new_id = str_pad($number + 1, 3, "0", STR_PAD_LEFT);
            $id = 'PR' . $new_id;
        };
        Product::create(['id_produk' => $id] + $request->all());

        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_produk)
    {
        $product = Product::findOrFail($id_produk);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_produk)
    {
        $product = Product::findOrFail($id_produk);

        $product->update($request->all());

        Alert::success('Produk berhasil diperbarui')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_produk)
    {

        $check = Rental::Where('id_produk', $id_produk)->count();
        if ($check > 0) {
            return response()->json([

                'error' => 'error'

            ]);
        } else {

            $product = Product::findOrFail($id_produk);
            $product->delete();
            return response()->json(['success' => 'Post created successfully.']);
        }
    }

    public function print_pdf(Request $request)
    {

        if ($request->has('search')) {
            $products = Product::where('camera', 'like', '%' . $request->search . '%')->get();
        } else {
            $products = Product::orderBy('created_at', 'DESC')->get();
        }
        $time = Carbon::now('Asia/Jakarta');

        $pdf = PDF::loadview('product.print', ['products' => $products], ['time' => $time]);
        return $pdf->stream();
    }
}
