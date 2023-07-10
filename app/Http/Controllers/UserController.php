<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->search . '%')
            ->paginate(10);
        } else {
            $users = User::orderBy('created_at', 'DESC')->paginate(10);
        }

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Alert::success('User Success Created')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);

        return redirect('/user');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_user)
    {
        $users = User::findOrFail($id_user);

        return view('user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_user)
    {
        $user = User::findOrFail($id_user);

        $user->update($request->all());

        Alert::success('Produk berhasil diperbarui')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_user)
    {
        $user = User::findOrFail($id_user);

        $user->delete();

        return response()->json(['success' => 'Post created successfully.']);
    }
}