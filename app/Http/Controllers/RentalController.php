<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rental = Rental::orderBy('created_at', 'DESC')->get();

        return view('rental.index', compact('rental'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rental.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        rental::create($request->all());

        return redirect()->route('rental.index')->with('success', 'rental added successfully');
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

        return view('rental.edit', compact('rental'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_rental)
    {
        $rental = Rental::findOrFail($id_rental);

        $rental->update($request->all());

        return redirect()->route('rental.index')->with('success', 'rental updated successfully');
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
