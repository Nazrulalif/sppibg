<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\Tahun_pelajar;
use App\Models\User;
use App\Models\Yuran;
use App\Models\Yuran_bayar;
use App\Models\Yuran_tambahan;
use App\Models\Yuran_tambahan_kategori;
use App\Models\Yuran_tambahan_pelajar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminYuranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Yuran::select('tahun', 'yuran')->distinct()->get();

            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->created_at)->format('j F Y');
                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }

        // Retrieve distinct years and corresponding PIBG fees
        $yearsAndFees = Yuran::select('tahun', 'yuran')->distinct()->get();

        // return view('admin.fee.details', ['feeDetails' => $feeDetails]);

        return view('admin.admin-yuran', [
            'year' =>   $yearsAndFees,
        ]);
    }

    public function yuran_tambah()
    {
        $kategori_tahun = Tahun_pelajar::all();
        // $kategori = Yuran_tambahan_kategori::all();
        return view('admin.admin-tambah-yuran', [
            'tahun' => $kategori_tahun,
        ]);
    }

    // public function yuran_simpan(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'tahun' => 'required|integer',
    //         'harga' => 'required|numeric',
    //     ]);

    //     // Create Yuran record
    //     $yuran = Yuran::create([
    //         'tahun' => $request->tahun,
    //         'harga' => $request->harga,
    //     ]);

    //     foreach ($request->harga_tambahan as $key => $harga) {
    //         $yuran_tambahan = Yuran_tambahan::create([
    //             'id_yuran' => $yuran->id,
    //             'tahun_pelajar' => $request->tahun_pelajar[$key],
    //             'harga' => $harga,
    //         ]);
    //     }


    //     // Select users who have child records in the pelajar table
    //     $users = User::select('users.*', 'pelajar.id as id_pelajar')
    //         ->join('pelajar', 'users.id', '=', 'pelajar.id_pengguna')
    //         ->where('users.verified', '!=', '2')
    //         ->where('users.verified', '!=', '3')
    //         // ->distinct()
    //         ->get();

    //     // Get the IDs of users with children
    //     // $userIdsWithChildren = $users->pluck('users.id')->toArray();

    //     // Create Yuran_bayar records for users with children
    //     foreach ($users as $users) {
    //         Yuran_bayar::create([
    //             'id_yuran' => $yuran->id,
    //             'id_pengguna' => $users->id,
    //             'id_pelajar' => $users->id_pelajar,
    //             'jumlah_bayar' => '0',
    //             'jumlah_yang_tinggal' => '0',
    //             'cara_bayar' => 'PayPal',
    //             'status' => 'Belum Bayar',
    //         ]);
    //     }
    //     session()->flash('success', 'Yuran baharu berjaya ditambah');
    //     echo '<script>window.opener.location.reload(); window.close();</script>';
    // }
    public function yuran_simpan(Request $request)
    {
        $validatedData = $request->validate([
            'year' => 'required|numeric',
            'pibg_fee' => 'required|numeric',
            'grade_fees.*' => 'required|numeric',
        ]);

        foreach ($validatedData['grade_fees'] as $gradeId => $fee) {
            Yuran::create([
                'tahun' => $validatedData['year'],
                'yuran' => $validatedData['pibg_fee'],
                'tahun_pelajar_id' => $gradeId,
                'yuran_tambahan' => $fee,
            ]);
        }
        session()->flash('success', 'Yuran baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }


    // public function yuran_simpan_tambahan(Request $request, $id)
    // {

    //     // dd($id);
    //     // Loop through perkara and save details
    //     foreach ($request->harga_tambahan as $index => $harga_tambahan) {
    //         Yuran_tambahan::create([
    //             'id_yuran' => $id,
    //             'perkara' => $request->perkara,
    //             'tahun_pelajar' => $request->tahun_pelajar[$index],
    //             'harga' => $harga_tambahan, // Use harga_tambahan instead of harga
    //         ]);
    //     }



    //     return redirect()->back();
    // }

    // public function yuran_tambahan_padam(Request $request)
    // {
    //     // Find all rows with the specified perkara
    //     $perkara = $request->input('perkara');
    //     $id = $request->input('id');

    //     // dd($perkara);
    //     // Assuming YourModel is the model for your database table
    //     Yuran_tambahan::where('perkara', $perkara)
    //         ->where('id_yuran', $id)
    //         ->delete();

    //     // return response()->json(['message' => 'Rows deleted successfully']);
    //     return redirect()->back();
    // }

    public function yuran_padam($year)
    {
        $yuran = Yuran::where('tahun', $year)->get();

        foreach ($yuran as $fee) {
            $fee->delete();
        }
        return redirect()->back()->with('success', 'Yuran berjaya dipadam');
    }

    // public function yuran_edit($id)
    // {
    //     $yuran = Yuran::find($id);

    //     $yuran_tambahan = Yuran_tambahan::where('id_yuran', $id)->get();


    //     // $yuran_tambahan = Yuran::select('*', 'yuran.id as id')
    //     //     ->join('yuran_tambahan', 'yuran.id', '=', 'yuran_tambahan.id_yuran')
    //     //     ->where('yuran.id', $id)
    //     //     ->get();

    //     return view('admin.admin-edit-yuran', [
    //         'data' => $yuran,
    //         'yuran_tambahan' => $yuran_tambahan,
    //     ]);
    // }

    public function yuran_edit($year)
    {
        // $yuran = Yuran::find($year);

        // $yuran_tambahan = Yuran_tambahan::where('id_yuran', $year)->get();

        $data = Yuran_bayar::join('yuran', 'yuran_bayar.id_yuran', '=', 'yuran.id')
            ->join('pelajar', 'yuran_bayar.id_pelajar', '=', 'pelajar.id')
            ->join('users', 'pelajar.id_pengguna', '=', 'users.id')
            ->where('yuran.tahun', $year)->first();

        $kategori_tahun = Tahun_pelajar::all();

        // $yuran_tambahan = Yuran::select('*', 'yuran.id as id')
        //     ->join('yuran_tambahan', 'yuran.id', '=', 'yuran_tambahan.id_yuran')
        //     ->where('yuran.id', $id)
        //     ->get();

        return view('admin.admin-edit-yuran', [
            'data' => $data,
            'tahun_yuran' => $year,
            'tahun' => $kategori_tahun,
            // 'yuran_tambahan' => $yuran_tambahan,
        ]);
    }


    public function yuran_update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required',
            'harga' => 'required',
        ]);

        $yuran = Yuran::find($id);
        $yuran->tahun = $request->tahun;
        $yuran->harga = $request->harga;
        $yuran->save();

        session()->flash('success', 'Yuran berjaya dikemaskini');
        // return redirect()->back();
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    // public function yuran_butiran($id)
    // {
    //     $yuran = Yuran::where('id', $id)->first();

    //     $jumlah_kutipan = Yuran_bayar::where('id_yuran', $id)->sum('jumlah_bayar');
    //     $bayar_penuh = Yuran_bayar::where('id_yuran', $id)->where('status', 'Bayaran Penuh')->count();
    //     $bayar_separa = Yuran_bayar::where('id_yuran', $id)->where('status', 'Bayaran Separa')->count();
    //     $belum_bayar = Yuran_bayar::where('id_yuran', $id)->where('status', 'Belum Bayar')->count();


    //     $jumlah_pengguna = Yuran_bayar::where('id_yuran', $id)->count();
    //     $harga = yuran::where('id', $id)->first();
    //     $harga_yuran = $harga->harga;
    //     $jumlah_keseluruhan = $harga_yuran * $jumlah_pengguna;

    //     $baki_kutipan = $jumlah_keseluruhan - $jumlah_kutipan;

    //     return view('admin.admin-butiran-yuran', [
    //         'data' => $id,
    //         'yuran' => $yuran,
    //         'jumlah_kutipan' => $jumlah_kutipan,
    //         'jumlah_keseluruhan' => $jumlah_keseluruhan,
    //         'bayar_penuh' => $bayar_penuh,
    //         'bayar_separa' => $bayar_separa,
    //         'belum_bayar' => $belum_bayar,
    //     ]);
    // }

    public function yuran_butiran($year)
    {

        $jumlah_kutipan = Yuran_bayar::join('yuran', 'yuran_bayar.id_yuran', '=', 'yuran.id')
            ->where('yuran.tahun', $year)->sum('yuran_bayar.jumlah_yuran');

        $selesai = Yuran_bayar::join('yuran', 'yuran_bayar.id_yuran', '=', 'yuran.id')
            ->where('yuran.tahun', $year)->count('yuran_bayar.status', 'Selesai');

        $belum_selesai = Pelajar::leftJoin('yuran_bayar', function ($join) use ($year) {
            $join->on('pelajar.id', '=', 'yuran_bayar.id_pelajar')
                ->join('yuran', 'yuran_bayar.id_yuran', '=', 'yuran.id')
                ->where('yuran.tahun', $year);
        })
            ->whereNull('yuran_bayar.id')
            ->count();

        $jumlah_pelajar = Pelajar::count();



        // dd($jumlah_pelajar);
        return view('admin.admin-butiran-yuran', [
            // 'paymentDetails' => $paymentDetails,
            'data' => $year,
            'jumlah_kutipan' => $jumlah_kutipan,
            'selesai' => $selesai,
            'belum_selesai' => $belum_selesai,
            'jumlah_pelajar' => $jumlah_pelajar,
        ]);
    }


    public function senarai_bayar(Request $request, $year)
    {
        if ($request->ajax()) {


            $data = Yuran_bayar::select('*', 'yuran_bayar.id as id')
                ->join('yuran', 'yuran_bayar.id_yuran', '=', 'yuran.id')
                ->join('pelajar', 'yuran_bayar.id_pelajar', '=', 'pelajar.id')
                ->join('users', 'pelajar.id_pengguna', '=', 'users.id')
                ->where('yuran.tahun', $year)
                ->where('yuran_bayar.status', 'Selesai')->get();

            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->created_at)->format('j F Y');
                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.admin-butiran-yuran');
    }

    public function resit_yuran($id)
    {
        $resit = Yuran_bayar::select('*', 'users.name as nama_pengguna')
            ->join('pelajar', 'yuran_bayar.id_pelajar', '=', 'pelajar.id')
            ->join('users', 'pelajar.id_pengguna', '=', 'users.id')
            ->join('yuran', 'yuran_bayar.id_yuran', '=', 'yuran.id')
            ->where('yuran_bayar.id', $id)
            ->first();

        return view('admin.admin-resit-yuran', [
            'resit' => $resit,
        ]);
    }
}
