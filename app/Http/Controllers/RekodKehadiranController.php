<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran_pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekodKehadiranController extends Controller
{
    public function index()
    {
        $rekod = Kehadiran_pengguna::join('kehadiran', 'kehadiran_pengguna.id_kehadiran', '=', 'kehadiran.id')
            ->join('mesyuarat', 'kehadiran.id_mesyuarat', '=', 'mesyuarat.id')
            ->join('users', 'kehadiran_pengguna.id_pengguna', '=', 'users.id')
            ->where('kehadiran_pengguna.id_pengguna', Auth::user()->id)
            ->get();

        $hadir = Kehadiran_pengguna::join('kehadiran', 'kehadiran_pengguna.id_kehadiran', '=', 'kehadiran.id')
            ->join('mesyuarat', 'kehadiran.id_mesyuarat', '=', 'mesyuarat.id')
            ->join('users', 'kehadiran_pengguna.id_pengguna', '=', 'users.id')
            ->where('kehadiran_pengguna.id_pengguna', Auth::user()->id)
            ->where('kehadiran_pengguna.status', 'Hadir')
            ->count();

        $tidak_hadir = Kehadiran_pengguna::join('kehadiran', 'kehadiran_pengguna.id_kehadiran', '=', 'kehadiran.id')
            ->join('mesyuarat', 'kehadiran.id_mesyuarat', '=', 'mesyuarat.id')
            ->join('users', 'kehadiran_pengguna.id_pengguna', '=', 'users.id')
            ->where('kehadiran_pengguna.id_pengguna', Auth::user()->id)
            ->where('kehadiran_pengguna.status', 'Tidak Hadir')
            ->count();


        return view('user.rekod-kehadiran', [
            'rekod' => $rekod,
            'hadir' => $hadir,
            'tidak_hadir' => $tidak_hadir,
        ]);
    }
}
