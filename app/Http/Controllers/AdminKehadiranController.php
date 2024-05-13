<?php

namespace App\Http\Controllers;

use App\Models\Akses_pengguna;
use App\Models\Kehadiran;
use App\Models\Kehadiran_pengguna;
use App\Models\Mesyuarat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AdminKehadiranController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Kehadiran::select('*', 'kehadiran.id as id')
                ->join('mesyuarat', 'kehadiran.id_mesyuarat', '=', 'mesyuarat.id')
                ->get();

            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->tarikh)->format('j F Y');
                $item->formatted_mula = Carbon::parse($item->masa_mula)->format('h:i A');
                $item->formatted_tamat = Carbon::parse($item->masa_tamat)->format('h:i A');
                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }


        return view('admin.admin-kehadiran');
    }

    public function kehadiran_tambah()
    {
        $current_date = Carbon::now()->format('Y-m-d');

        $user_role = Akses_pengguna::all();


        $mesyuarat = Mesyuarat::where('tarikh', '>=', $current_date)
            // ->sortBy('tarikh')
            ->get();

        $existingIds = Kehadiran::pluck('id_mesyuarat')->toArray();


        return view('admin.admin-tambah-kehadiran', [
            'mesyuarat' => $mesyuarat,
            'existingIds' => $existingIds,
            'role' => $user_role,
        ]);
    }

    public function kehadiran_simpan(Request $request)
    {
        $data = $request->validate([
            'mesyuarat' => 'required|integer|exists:mesyuarat,id',
            'kepada' => 'required|array',
            'kepada.*' => 'exists:akses_pengguna,id',
        ], [
            'mesyuarat.integer' => 'Nama Mesyuarat perlu dipilih',
            'mesyuarat.required' => 'Nama Mesyuarat perlu dipilih',
            'kepada.required' => 'Pilih siapa yang terlibat',
            'kepada.*.required' => 'Pilih siapa yang terlibat',

        ]);

        // Create a new attendance record
        $acara = Kehadiran::create([
            'id_mesyuarat' => $request->mesyuarat,
        ]);

        // // Get users who belong to the selected roles
        // $users = User::join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
        //     ->whereIn('akses_pengguna.id', $data['kepada'])
        //     ->select('users.*')
        //     ->where('users', '!=', '2')
        //     ->where('users', '!=', '3')
        //     ->distinct()
        //     ->get();

        $users = User::join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            ->whereIn('akses_pengguna.id', $data['kepada'])
            ->select('users.*')
            ->whereNotIn('users.verified', [2, 3]) // Exclude specific access codes (e.g., 2 and 3)
            ->distinct()
            ->get();

        // Save the users to the Kehadiran_pengguna table
        foreach ($users as $user) {
            Kehadiran_pengguna::create([
                'id_kehadiran' => $acara->id,
                'id_pengguna' => $user->id,
                'status' => 'Tidak Hadir',
                // Add more columns as needed
            ]);
        }

        session()->flash('success', 'Acara baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }



    public function kehadiran_padam($id)
    {
        $data = Kehadiran::find($id);

        $data->delete();

        // dd($id);
        return redirect()->back()->with('success', 'Mesyuarat berjaya dipadam');
    }

    public function kehadiran_qr($id)
    {

        // $kehadiran = Kehadiran_pengguna::select(
        //     'kehadiran_pengguna.id_kehadiran',
        //     'kehadiran_pengguna.id_pengguna',
        //     'kehadiran_pengguna.status'
        // )
        //     ->join('kehadiran', 'kehadiran_pengguna.id_kehadiran', '=', 'kehadiran.id')
        //     ->where('kehadiran_pengguna.id_kehadiran', $id)
        //     ->get();


        $kehadiran = Kehadiran::where('id', $id)
            ->get();

        $mesyuarat = Kehadiran::join('mesyuarat', 'kehadiran.id_mesyuarat', '=', 'mesyuarat.id')
            ->where('kehadiran.id', $id)
            ->first();

        $qrCodes = [];
        // $randomValue = rand(1000, 9999); // Generate a random value

        $qrCodes['simple'] =
            QrCode::size(450)->generate($kehadiran);

        // return response()->json(['message' => $qrCodes]);

        return view('admin.admin-kehadiran-qr', [
            'data' => $id,
            'mesyuarat' => $mesyuarat,
        ], $qrCodes);
    }

    //test
    public function generate()
    {

        $qrCodes = [];
        $randomValue = rand(1000, 9999); // Generate a random value

        $qrCodes['simple'] =
            QrCode::size(250)->generate($randomValue);

        return view('admin.qrcode', $qrCodes);
    }

    public function updateCounts($id)

    {
        // dd($id);
        $jumlahCount = Kehadiran_pengguna::select('*')
            ->where('id_kehadiran', '=', $id)
            ->count();

        $hadirCount = Kehadiran_pengguna::where('status', 'Hadir')
            ->where('id_kehadiran', '=', $id)
            ->count();
        $tidakHadirCount = Kehadiran_pengguna::where('status', 'Tidak Hadir')
            ->where('id_kehadiran', '=', $id)
            ->count();

        return response()->json([
            'jumlahCount' => $jumlahCount,
            'hadirCount' => $hadirCount,
            'tidakHadirCount' => $tidakHadirCount,
        ]);
    }



    public function kehadiran_pengguna(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = Kehadiran_pengguna::select('*', 'kehadiran_pengguna.id as id')
                ->join('users', 'kehadiran_pengguna.id_pengguna', '=', 'users.id')
                // ->where('kehadiran_pengguna.id_pengguna', '!=', auth()->user()->id)
                ->where('kehadiran_pengguna.id_kehadiran', '=', $id)
                ->get();

            // $data = User::
            //     // ->rightjoin('kehadiran_pengguna', 'users.id', '=', 'kehadiran_pengguna.id_pengguna')
            //     // ->where('users.id', '!=', auth()->user()->id)
            //     all(); // Include the 'id' column here

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        // return view('admin.admin-kehadiran-qr');
    }

    public function kehadiran_qr_simpan($id, Request $request)
    {
        $kehadiran = Kehadiran_pengguna::findOrFail($id);

        // Update the status based on the request data
        $kehadiran->status = $request->status;
        $kehadiran->save();

        // You can return a success response if needed
        return response()->json(['message' => 'Attendance status updated successfully']);
    }

    public function kehadiran_qr_laporan($id)
    {
        $data = Kehadiran::join('mesyuarat', 'kehadiran.id_mesyuarat', '=', 'mesyuarat.id')
            ->where('kehadiran.id', $id)
            ->first();

        $pengguna = Kehadiran::join('kehadiran_pengguna', 'kehadiran.id', '=', 'kehadiran_pengguna.id_kehadiran')
            ->join('users', 'kehadiran_pengguna.id_pengguna', '=', 'users.id')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            ->where('kehadiran.id', $id)
            ->get();

        // dd($pengguna);

        return view('admin.admin-laporan-qr-kehadiran', [
            'data' => $data,
            'pengguna' => $pengguna,
        ]);
    }
}
