<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Retur;
use App\Models\Rental;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;

class ReturController extends Controller
{
    public function index()
    {
        $returs = Retur::orderByDesc('returs.created_at')
            ->join('rentals', 'returs.id_rental', '=', 'rentals.id_rental')
            ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
            ->select('returs.id_rental', 'customers.nama', 'returs.tanggal_kembali', 'returs.denda', 'returs.id_retur')
            ->paginate(10);

        return view('retur.index', compact('returs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rentals = Rental::Where('status', '=', '0')
            ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
            ->select('rentals.id_rental', 'customers.nama')
            ->get();
        return view('retur.create', compact('rentals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = Retur::count();
        if ($check == 0) {
            $idRe = 'RE001';
        } else {
            $getId = Rental::all()->last();
            $number = (int)substr($getId->id_rental, -1);
            $new_idRe = str_pad($number + 1, 3, "0", STR_PAD_LEFT);
            $idRe = 'RE' . $new_idRe;
        };
        retur::create(['id_retur' => $idRe] + $request->all());


        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('retur.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_retur)
    {
        $retur = Retur::findOrFail($id_retur);
        $customers = Customer::where('id_customer', $retur->id_customer)->get();
        $rentals = Rental::get();

        return view('retur.edit', compact('retur', 'rentals', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_retur)
    {
        $returs = Retur::findOrFail($id_retur);

        $returs->update($request->all());

        Alert::success('Retur berhasil diperbarui')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('retur.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_retur)
    {
        $returs = Retur::findOrFail($id_retur);

        $returs->delete();

        return redirect()->route('retur.index')->with('success', 'retur deleted successfully');
    }
}
