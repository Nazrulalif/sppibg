<?php

namespace App\Http\Controllers;

use App\Models\Mesyuarat;
use App\Models\Ulasan_usul;
use App\Models\Usul_kategori;
use App\Models\Usul_mesyuarat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminUsulMesyuaratController extends Controller
{
    public function index(Request $request, $id)
    {

        // dd($id);

        if ($request->ajax()) {

            $data = Usul_mesyuarat::select('*', 'usul_mesyuarat.created_at as created_at', 'usul_mesyuarat.id as id')
                ->join('users', 'usul_mesyuarat.id_pengguna', '=', 'users.id')
                ->where('usul_mesyuarat.pengesahan', 'Diterima')
                ->where('usul_mesyuarat.id_mesyuarat', $id)
                ->get();


            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->tarikh)->format('j F Y');

                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.admin-mesyuarat');
    }

    public function ulasan_laporan($id)
    {
        // $ulasan = Ulasan_usul::select('*', 'usul_kategori.nama_kategori as nama_kategori',)
        //     ->join('usul_mesyuarat', 'ulasan_usul.id_usul', '=', 'Usul_mesyuarat.id')
        //     ->join('mesyuarat', 'usul_mesyuarat.id_mesyuarat', '=', 'mesyuarat.id')
        //     ->join('users', 'usul_mesyuarat.id_pengguna', '=', 'users.id')
        //     ->join('usul_kategori', 'usul_mesyuarat.id_kategori', '=', 'usul_kategori.id')
        //     ->where('mesyuarat.id', $id)
        //     ->get();

        $ulasan = Mesyuarat::select('*')
            ->join('usul_mesyuarat', 'usul_mesyuarat.id_mesyuarat', '=', 'mesyuarat.id')
            ->leftjoin('ulasan_usul', 'Usul_mesyuarat.id', '=', 'ulasan_usul.id_usul')
            ->join('users', 'usul_mesyuarat.id_pengguna', '=', 'users.id')
            ->join('usul_kategori', 'usul_mesyuarat.id_kategori', '=', 'usul_kategori.id')
            ->where('usul_mesyuarat.pengesahan', 'Diterima')
            ->where('usul_mesyuarat.id_mesyuarat', $id)
            ->get();

        $mesyuarat = Mesyuarat::where('id', $id)->first();



        return view('admin.admin-laporan-usul', [
            'ulasan' => $ulasan,
            'mesyuarat' => $mesyuarat,
        ]);
    }


    public function usul_mesyuarat_pengesahan(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = Usul_mesyuarat::select('*', 'usul_mesyuarat.created_at as created_at', 'usul_mesyuarat.id as id')
                ->join('users', 'usul_mesyuarat.id_pengguna', '=', 'users.id')
                ->join('usul_kategori', 'usul_mesyuarat.id_kategori', '=', 'usul_kategori.id')
                ->where('usul_mesyuarat.pengesahan', 'Menunggu')
                ->where('usul_mesyuarat.id_mesyuarat', $id)
                ->get();


            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->created_at)->format('j F Y');

                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.admin-mesyuarat');
    }

    public function usul_mesyuarat_terima($id)
    {
        $data = Usul_mesyuarat::find($id);

        // dd($id);

        $data->update([
            'pengesahan' => 'Diterima',
        ]);

        return redirect()->back();
    }

    public function ulasan_usul($id)
    {
        $data = Usul_mesyuarat::select('*', 'usul_mesyuarat.created_at as created_at', 'usul_mesyuarat.id as id')
            ->join('users', 'usul_mesyuarat.id_pengguna', '=', 'users.id')
            ->join('usul_kategori', 'usul_mesyuarat.id_kategori', '=', 'usul_kategori.id')
            ->where('usul_mesyuarat.id', $id)
            ->first();

        $formatted_date = Carbon::parse($data->created_at)->format('j F Y');

        $ulasan = ulasan_usul::where('id_usul', '=', $id)->first();

        // dd($id);

        return view('admin.admin-ulasan-usul', [
            'data' => $data,
            'ulasan' => $ulasan,
            'formatted_date' => $formatted_date,
        ]);
    }

    public function ulasan_simpan($id, Request $request)
    {

        // dd($id);

        $data = $request->validate([
            'ulasan' => 'required',
        ], [
            'ulasan.required' => 'Ulasan perlu diisi',
        ]);

        // dd($date);
        $usul = Usul_mesyuarat::find($id);

        $usul->update([
            'status' => 'Dijawab',
        ]);

        $ulasan = Ulasan_usul::firstOrNew(['id_usul' => $id]);

        $ulasan->ulasan = $request->ulasan;

        $ulasan->save();

        session()->flash('success', 'Ulasan baharu berjaya disimpan');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function usul_mesyuarat_tolak($id)
    {
        $data = Usul_mesyuarat::find($id);

        $data->update([
            'pengesahan' => 'Ditolak',
            'status' => 'Ditolak',
        ]);

        return redirect()->back();
    }
}
