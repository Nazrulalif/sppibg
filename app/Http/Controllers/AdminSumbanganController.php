<?php

namespace App\Http\Controllers;

use App\Models\Sumbangan;
use App\Models\Sumbangan_pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminSumbanganController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sumbangan::where('status', 'aktif')->get();

            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->tarikh)->format('j F Y');

                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.admin-sumbangan');
    }
    public function arkib(Request $request)
    {
        if ($request->ajax()) {
            $data = Sumbangan::where('status', 'tidak aktif')->get();

            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->tarikh)->format('j F Y');

                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.admin-sumbangan');
    }

    public function sumbangan_padam($id)
    {
        $data = Sumbangan::find($id);

        $data->delete();

        // dd($data);
        return redirect()->back()->with('success', 'Sumbangan berjaya dipadam');
    }

    public function sumbangan_nyahaktif($id)
    {
        $data = Sumbangan::find($id);

        $data->update(['status' => 'tidak aktif']); // Corrected syntax

        return redirect()->back()->with('success', 'Sumbangan berjaya dinyah aktif');
    }

    public function sumbangan_tambah()
    {
        return view('admin.admin-tambah-sumbangan');
    }

    public function sumbangan_simpan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'sasaran' => 'required',
            'penerangan' => 'required',

        ]);

        // dd($date);

        $mesyuarat = Sumbangan::create([
            'nama_sumbangan' => $request->nama,
            'jumlah_sasaran' => $request->sasaran,
            'penerangan' => $request->penerangan,
            'status' => 'aktif',

        ]);

        session()->flash('success', 'Acara baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function sumbangan_edit($id)
    {
        $data = Sumbangan::find($id);
        return view('admin.admin-edit-sumbangan', [
            'data' => $data,
        ]);
    }

    public function sumbangan_update($id)
    {
        $data = Sumbangan::find($id);

        $data->update([
            'nama_sumbangan' => request('nama'),
            'jumlah_sasaran' => request('sasaran'),
            'penerangan' => request('penerangan'),
        ]);

        session()->flash('success', 'Mesyuarat berjaya dikemaskini');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function sumbangan_butiran($id, Request $request)
    {
        $sumbangan = Sumbangan::select('*')
            // ->join('sumbangan_pengguna', 'sumbangan.id', '=', 'sumbangan_pengguna.id_sumbangan')
            ->where('sumbangan.id', $id)->first();

        $jumlah_sumbangan = Sumbangan_pengguna::where('id_sumbangan', $id)->sum('jumlah_sumbangan');

        if ($request->ajax()) {
            $data = Sumbangan_pengguna::select('*', 'sumbangan_pengguna.id as id')
                ->join('users', 'sumbangan_pengguna.id_pengguna', '=', 'users.id')
                ->where('id_sumbangan', $id)->get();

            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->created_at)->format('j F Y');
                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.admin-butiran-sumbangan', [
            'data' => $id,
            'sumbangan' => $sumbangan,
            'jumlah_sumbangan' => $jumlah_sumbangan,
        ]);
    }

    public function sumbangan_resit($id)
    {
        $resit = Sumbangan_pengguna::select('*', 'sumbangan_pengguna.id as id')
            ->join('sumbangan', 'sumbangan_pengguna.id_sumbangan', '=', 'sumbangan.id')
            ->join('users', 'sumbangan_pengguna.id_pengguna', '=', 'users.id')
            ->where('sumbangan_pengguna.id', $id)
            ->first();
        return view('admin.admin-resit-sumbangan', [
            'resit' => $resit,
        ]);
    }
}
