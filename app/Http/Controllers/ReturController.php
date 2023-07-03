<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Retur;

class ReturController extends Controller
{
    public function index()
    {
        $retur = Retur::orderBy('created_at', 'DESC')->get();

        return view('retur.index', compact('retur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('retur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        retur::create($request->all());

        return redirect()->route('retur.index')->with('success', 'retur added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_customer)
    {
        $retur = Retur::findOrFail($id_customer);

        return view('retur.show', compact('retur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_customer)
    {
        $retur = Retur::findOrFail($id_customer);

        return view('retur.edit', compact('retur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_customer)
    {
        $retur = Retur::findOrFail($id_customer);

        $retur->update($request->all());

        return redirect()->route('retur.index')->with('success', 'retur updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        $retur = Retur::findOrFail($id_customer);

        $retur->delete();

        return redirect()->route('retur.index')->with('success', 'retur deleted successfully');
    }
}
