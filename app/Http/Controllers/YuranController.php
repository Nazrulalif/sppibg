<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\User;
use App\Models\Yuran;
use App\Models\Yuran_bayar;
use App\Models\Yuran_tambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        $provider->getAccessToken();
        // Validate the request data
        $request->validate([
            'student_id' => 'required|integer',
            'fee' => 'required|numeric',
        ]);


        $respond = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "brand_name" => "SPPIBG",
                "return_url" => route('pembayaran-yuran-berjaya'),
                "cancel_url" => route('pembayaran-yuran-gagal'),
                "shipping_preference" => "NO_SHIPPING"
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "MYR",
                        "value" => $request->fee
                    ]
                ]
            ]

        ]);

        // dd($respond);

        if (isset($respond['id']) && $respond['id'] != null) {
            foreach ($respond['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    // Store the id_pelajar and id_yuran in the session
                    session(['id_pelajar' => $request->student_id]);
                    session(['id_yuran' => $request->id_yuran]);

                    $payment = Yuran_bayar::create([
                        'id_yuran' => $request->id_yuran,
                        'id_pelajar' => $request->student_id,
                        'jumlah_yuran' => $request->fee,
                        'status' => 'Menunggu Pembayaran',
                        'jenis_pembayaran' => 'Paypal',
                        'id_pembayaran' => $respond['id'], // Store the PayPal order ID for reference
                    ]);

                    session(['id_payment' => $payment->id]);

                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('pembayaran-yuran-gagal');
        }
    }

    public function pembayaran_yuran_berjaya(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $respond = $provider->capturePaymentOrder($request->token);

        // Retrieve the id_pelajar and id_yuran from the session
        $id_pelajar = session('id_pelajar');
        $id_yuran = session('id_yuran');
        $id_payment = session('id_payment');

        if (!$id_pelajar || !$id_yuran) {
            // Session values not found, handle the error
            return redirect()->route('pembayaran-yuran-gagal')->with('error', 'Session data not found');
        }

        if (isset($respond['status']) && $respond['status'] == 'COMPLETED') {
            $payment = Yuran_bayar::where('id_pelajar', $id_pelajar)
                ->where('id_yuran', $id_yuran)
                ->where('id', $id_payment)
                ->update(['status' => 'Selesai']);

            return redirect()->route('yuran')->with('success', 'Pembayaran berjaya');
        } else {
            $payment = Yuran_bayar::where('id_pelajar', $id_pelajar)
                ->where('id_yuran', $id_yuran)
                ->where('id', $id_payment)
                ->update(['status' => 'Pembayaran Gagal']);
            return redirect()->route('pembayaran-yuran-gagal');
        }
    }

    public function pembayaran_yuran_gagal(Request $request)
    {
        $id_pelajar = session('id_pelajar');
        $id_yuran = session('id_yuran');
        $id_payment = session('id_payment');

        if (!$id_pelajar || !$id_yuran) {
            // Session values not found, handle the error
            return redirect()->route('pembayaran-yuran-gagal')->with('error', 'Session data not found');
        }

        $payment = Yuran_bayar::where('id_pelajar', $id_pelajar)
            ->where('id_yuran', $id_yuran)
            ->where('id', $id_payment)
            ->update(['status' => 'Pembayaran Gagal']);
        return redirect()->route('yuran')->with('error', 'Pembayaran Gagal');
    }
}
