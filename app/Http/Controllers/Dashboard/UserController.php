<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list mesin
        $users = User::notKabag()->filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('user.store');
        $lokasi = Lokasi::all();
        return view('pages.dashboard.user._form', compact('method', 'url', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'nik' => 'required|unique:users,nik',
            'password' => 'required',
            'role' => 'required',
            'lokasi' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->lokasi_id = $request->lokasi;

        $user->save();

        return redirect()->back()->with('success', 'User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $method = "update";
        $url = route('user.update', $id);
        $user = User::findOrFail($id);
        $lokasi = Lokasi::all();
        return view('pages.dashboard.user._form', compact('method', 'url', 'user', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:users,name,' . $id,
            'nik' => 'required|unique:users,nik,' . $id,
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->role = $request->role;
        $user->lokasi_id = $request->lokasi;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete user success',
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error',
            ]);

            return back()->withInput();
        }
    }
}
