<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'nik' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::where('nik', 'LIKE', "%{$request->nik}%")->first();

            if ($user->role == '1') {
                return redirect()->route('mesin.index')->with('success', 'Berhasil login');
            }
            if ($user->role == '2') {
                return redirect()->route('mesin.index')->with('success', 'Berhasil login');
            }
            if ($user->role == '3') {
                return redirect()->route('perawatan-mingguan.index')->with('success', 'Berhasil login');
            }
            if ($user->role == '4') {
                return redirect()->route('produksi.index')->with('success', 'Berhasil login');
            }
            if ($user->role == '5') {
                return redirect()->route('perawatan.index')->with('success', 'Berhasil login');
            }
        };

        return back()->with('error', 'The provided credentials do not match our records.')->onlyInput('name');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
