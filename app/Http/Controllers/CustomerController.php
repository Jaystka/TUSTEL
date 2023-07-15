<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Rental;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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
        $check = Customer::count();
        if ($check == 0) {
            $id = 'C0001';
        } else {
            $getId = Customer::all()->last();
            $number = (int)substr($getId->id_customer, -4);
            $new_id = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            $id = 'C' . $new_id;
        };
        customer::create(['id_customer' => $id] + $request->all());

        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('customer.index');
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
        $check = Rental::Where('id_customer', $id_customer)->count();

        if ($check == 0) {
            $customers->delete();
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
            $customers = Customer::where('nama', 'like', '%' . $request->search . '%')->get();
        } else {
            $customers = Customer::orderBy('created_at', 'DESC')->get();
        }
        $time = Carbon::now('Asia/Jakarta');

        $pdf = PDF::loadview('customer.print', ['customers' => $customers], ['time' => $time]);
        return $pdf->stream();
    }
}
