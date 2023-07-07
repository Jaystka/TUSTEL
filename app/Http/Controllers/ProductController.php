<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);


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
        Product::create($request->all());

        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_produk)
    {
        $product = Product::findOrFail($id_produk);

        return view('product.show', compact('product'));
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
        $product = Product::findOrFail($id_produk);

        $product->delete();

        $title = 'Hapus Produk!';
        $text = "Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('product.index', compact('product'));

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus');
    }

    public function search(Request $request)
    {
        $products = Product::where([
            ['camera', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('camera', 'LIKE', '%' . $s . '%')
                        ->orWhere('harga', 'LIKE', '%' . $s . '%')
                        ->orderBy('created_at', 'DESC')->get();
                }
            }]
        ])->paginate(10);


        return view('product.search', compact('products'));
    }
}
