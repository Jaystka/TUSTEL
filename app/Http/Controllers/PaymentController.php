<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $payments = Payment::join('rentals', 'payments.id_rental', '=', 'rentals.id_rental')
                ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
                ->where('customers.nama', 'like', '%' . $request->search . '%')
                ->orWhere('jenis', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {

            $payments = Payment::orderBy('created_at', 'DESC')
            ->join('rentals', 'payments.id_rental', '=', 'rentals.id_rental')
            ->join('customers', 'rentals.id_customer', '=', 'customers.id_customer')
            ->select('payments.*', 'customers.nama')
            ->paginate(10);
        }

        return view('payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = Payment::count();
        if ($check == 0) {
            $id = 'P0001';
        } else {
            $getId = payment::all()->last();
            $number = (int)substr($getId->id_pembayaran, -4);
            $new_id = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            $id = 'P' . $new_id;
        };
        Payment::create(['id_pembayaran' => $id] + $request->all());

        return redirect()->route('payment.index')->with('success', 'payment added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_pembayaran)
    {
        $payment = Payment::findOrFail($id_pembayaran);

        return view('payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_pembayaran)
    {
        $payment = Payment::findOrFail($id_pembayaran);

        $payment->update($request->all());

        return redirect()->route('payment.index')->with('success', 'payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_pembayaran)
    {
        $payment = Payment::findOrFail($id_pembayaran);

        $payment->delete();

        return redirect()->route('payment.index')->with('success', 'payment deleted successfully');
    }
}