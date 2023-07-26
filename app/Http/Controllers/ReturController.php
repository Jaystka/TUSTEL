<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Retur;
use App\Models\Rental;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReturController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $returs = Retur::join('rentals', 'returs.id_rental', '=', 'rentals.id_rental')
                ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
                ->where('customers.nama', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {

            $returs = Retur::orderByDesc('returs.created_at')
                ->join('rentals', 'returs.id_rental', '=', 'rentals.id_rental')
                ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
                ->select('returs.id_rental', 'customers.nama', 'returs.tanggal_kembali', 'returs.denda', 'returs.id_retur')
                ->paginate(10);
        }



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
            $number = (int)substr($getId->id_rental, -3);
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

        return view('retur.edit', compact('retur'));
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

        if ($returs->delete()) {
            return response()->json([
                'success' => 'Post deleted successfully.'
            ]);
        } else {
            return response()->json([
                'error' => 'Failed to delete post.'
            ]);
        }
    }

    public function print_pdf(Request $request)
    {

        if ($request->has('search')) {
            $returs = Retur::join('rentals', 'returs.id_rental', '=', 'rentals.id_rental')
                ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
                ->where('customers.nama', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            $returs = Retur::orderByDesc('returs.created_at')
                ->join('rentals', 'returs.id_rental', '=', 'rentals.id_rental')
                ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
                ->select('returs.id_rental', 'customers.nama', 'returs.tanggal_kembali', 'returs.denda', 'returs.id_retur')
                ->get();
        }
        $time = Carbon::now('Asia/Jakarta');

        $pdf = PDF::loadview('retur.print', ['returs' => $returs], ['time' => $time]);
        return $pdf->stream();
    }
}
