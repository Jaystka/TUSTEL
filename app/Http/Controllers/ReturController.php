<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Retur;
use RealRashid\SweetAlert\Facades\Alert;

class ReturController extends Controller
{
    public function index()
    {
        $returs = Retur::orderByDesc('returs.created_at')
            ->paginate(10);

        return view('retur.index', compact('returs'));
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

        Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('retur.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_customer)
    {
        $returs = Retur::findOrFail($id_customer);

        return view('retur.show', compact('returs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_customer)
    {
        $returs = Retur::findOrFail($id_customer);

        return view('retur.edit', compact('returs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_customer)
    {
        $returs = Retur::findOrFail($id_customer);

        $returs->update($request->all());

        Alert::success('Retur berhasil diperbarui')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('retur.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        $returs = Retur::findOrFail($id_customer);

        $returs->delete();

        return redirect()->route('retur.index')->with('success', 'retur deleted successfully');
    }
}
