<?php

namespace App\Http\Controllers;

use App\Models\Buletin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $user = User::select('*', 'users.id as id')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id',)
            ->where('users.access_code', Auth::user()->access_code)
            ->first();

        $buletin = Buletin::where('id_draf', '2')->paginate(3);

        return view('user.halaman-utama', [
            'user' => $user,
            'buletin' => $buletin,
        ]);
    }

    public function borang_profil()
    {
        $user = User::select('*', 'users.id as id')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id',)
            ->where('users.access_code', Auth::user()->access_code)
            ->first();

        return view('user.borang-profil', [
            'user' => $user,
        ]);
    }

    public function profil_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email',

        ], [
            'name.required' => 'Nama diperlukan.',
            'ic.required' => 'Nombor kad Pengenalan diperlukan.',
            'phone.required' => 'Nombor telefon diperlukan',
            'address.required' => 'Alamat diperlukan',
            'email.required' => 'Emel diperlukan',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->no_ic = $request->ic;
        $user->no_phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('laman-utama')->with('success', 'Maklumat profil berjaya dikemas kini');
    }
}
