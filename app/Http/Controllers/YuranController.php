<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\User;
use App\Models\Yuran;
use App\Models\Yuran_bayar;
use App\Models\Yuran_tambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YuranController extends Controller
{
    public function index()
    {
        $data = User::select('*', 'users.id as id', 'users.hubungan')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            ->where('users.id', Auth::user()->id)
            ->first(); // Include the 'id' column here

        $pelajar = Pelajar::join('users', 'pelajar.id_pengguna', '=', 'users.id')
            ->where('pelajar.id_pengguna', Auth::user()->id)
            ->get();

        $user = Auth::user(); // Assuming you are using Laravel's built-in authentication
        $students = Pelajar::where('id_pengguna', $user->id)
            ->join('yuran', 'pelajar.tahun_pelajar_id', '=', 'yuran.tahun_pelajar_id')
            // ->leftJoin('yuran_bayar', 'pelajar.id', '=', 'yuran_bayar.id_pelajar')
            ->select('pelajar.*', 'yuran.yuran', 'yuran.yuran_tambahan', 'yuran.tahun as tahun_yuran', 'yuran.id as id_yuran')
            ->get();

        // Check if the status is "selesai" in the yuran_bayar table for each student
        foreach ($students as $student) {
            $paymentStatus = Yuran_bayar::where('id_yuran', $student->id_yuran)
                ->where('id_pelajar', $student->id)
                ->where('status', 'Selesai')
                ->exists();

            // Update the $student object with the paymentStatus property
            $student->paymentStatus = $paymentStatus ? 'Selesai' : 'Belum Selesai';
        }

        // dd($students);

        return view('user.yuran', [
            'user' => $data,
            'students' => $students,
            'pelajar' => $pelajar,
        ]);
    }

    public function pembayaran_yuran(Request $request)
    {
        // Validate the request data
        $request->validate([
            'student_id' => 'required|integer',
            'fee' => 'required|numeric',
        ]);

        // Create a new Payment instance
        $payment = Yuran_bayar::create([
            'id_yuran' => $request->id_yuran,
            'id_pelajar' => $request->student_id,
            'jumlah_yuran' => $request->fee,
            'status' => 'Selesai',
        ]);


        return redirect()->back();
    }
}
