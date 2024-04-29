<?php

namespace App\Http\Controllers;

use App\Models\Sumbangan;
use App\Models\Sumbangan_pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class SumbanganController extends Controller
{
    public function index()
    {

        $sumbangan = Sumbangan::where('status', 'aktif')->get();

        $jumlah_kutipan = Sumbangan::join('sumbangan_pengguna', 'sumbangan.id', '=', 'sumbangan_pengguna.id_sumbangan')
            ->selectRaw('id_sumbangan, sum(jumlah_sumbangan) as total_kutipan')
            ->groupBy('id_sumbangan')
            ->get()
            ->keyBy('id_sumbangan');


        $pengguna = Sumbangan::join('sumbangan_pengguna', 'sumbangan.id', '=', 'sumbangan_pengguna.id_sumbangan')
            ->where('sumbangan_pengguna.id_pengguna', Auth::user()->id)
            // ->groupBy('sumbangan_pengguna.id_pengguna')
            ->first();

        // dd($pengguna);
        return view('user.sumbangan', [
            'sumbangan' => $sumbangan,
            'jumlah_kutipan' => $jumlah_kutipan,
            'pengguna' => $pengguna,
        ]);
    }

    public function pembayaran_sumbangan(Request $request)
    {
        // $data = $request->validate([
        //     'amount' => 'required',
        // ]);
        $pengguna = Auth::user()->id;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        $provider->getAccessToken();
        // Validate the request data

        if ($request->customAmount == null) {
            $respond = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "brand_name" => "SPPIBG",
                    "return_url" => route('pembayaran-sumbangan-berjaya'),
                    "cancel_url" => route('pembayaran-sumbangan-gagal'),
                    "shipping_preference" => "NO_SHIPPING"
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "MYR",
                            "value" => $request->amount
                        ]
                    ]
                ]

            ]);
        } else {
            $respond = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "brand_name" => "SPPIBG",
                    "return_url" => route('pembayaran-sumbangan-berjaya'),
                    "cancel_url" => route('pembayaran-sumbangan-gagal'),
                    "shipping_preference" => "NO_SHIPPING"
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "MYR",
                            "value" => $request->customAmount
                        ]
                    ]
                ]

            ]);
        }



        if (isset($respond['id']) && $respond['id'] != null) {
            foreach ($respond['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    // Store the id_pelajar and id_yuran in the session
                    session(['id_sumbangan' => $request->id_sumbangan]);

                    if ($request->customAmount == null) {
                        $payment = Sumbangan_pengguna::create([
                            'jumlah_sumbangan' => $request->amount,
                            'id_sumbangan' => $request->id_sumbangan,
                            'id_pengguna' => $pengguna,
                            'id_transaksi' => $respond['id'],
                            'status' => 'Menunggu Pembayaran',
                            'jenis_pembayaran' => 'Paypal',

                        ]);
                        session(['id_payment' => $payment->id]);
                    } else {
                        $payment = Sumbangan_pengguna::create([
                            'jumlah_sumbangan' => $request->customAmount,
                            'id_sumbangan' => $request->id_sumbangan,
                            'id_pengguna' => $pengguna,
                            'id_transaksi' => $respond['id'],
                            'status' => 'Menunggu Pembayaran',
                            'jenis_pembayaran' => 'Paypal',


                        ]);
                        session(['id_payment' => $payment->id]);
                    }

                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('pembayaran-yuran-gagal');
        }
    }

    public function pembayaran_sumbangan_berjaya(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $respond = $provider->capturePaymentOrder($request->token);

        // Retrieve the id_pelajar and id_yuran from the session
        $id_sumbangan = session('id_sumbangan');
        $payment = session('id_payment');

        if (isset($respond['status']) && $respond['status'] == 'COMPLETED') {
            $payment = Sumbangan_pengguna::where('id_sumbangan', $id_sumbangan)
                ->where('id_pengguna', Auth::user()->id)
                ->where('id', $payment)
                ->update(['status' => 'Selesai']);

            return redirect()->route('sumbangan')->with('success', 'Pembayaran berjaya');
        } else {
            $payment = Sumbangan_pengguna::where('id_sumbangan', $id_sumbangan)
                ->where('id_pengguna', Auth::user()->id)
                ->where('id', $payment)
                ->update(['status' => 'Pembayaran Gagal']);

            return redirect()->route('pembayaran-sumbangan-gagal');
        }
    }

    public function pembayaran_sumbangan_gagal(Request $request)
    {
        $id_sumbangan = session('id_sumbangan');
        $payment = session('id_payment');

        $payment = Sumbangan_pengguna::where('id_sumbangan', $id_sumbangan)
            ->where('id_pengguna', Auth::user()->id)
            ->where('id', $payment)
            ->update(['status' => 'Pembayaran Gagal']);
        return redirect()->route('sumbangan')->with('error', 'sumbangan Gagal');
    }
}
