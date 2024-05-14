<?php

namespace App\Http\Controllers;

use App\Models\Ulasan_usul;
use App\Models\Usul_kategori;
use App\Models\Usul_mesyuarat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UsulMesyuaratController extends Controller
{
    public function index(Request $request, $id)
    {

        if ($request->ajax()) {

            $user = Auth::user()->id;

            $data = Usul_mesyuarat::select('*', 'usul_mesyuarat.id as id')
                ->join('usul_kategori', 'usul_mesyuarat.id_kategori', '=', 'usul_kategori.id')
                ->where('usul_mesyuarat.id_pengguna', '=', $user)->where('usul_mesyuarat.id_mesyuarat', $id)->get();


            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->created_at)->format('j F Y');
                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.usul-mesyuarat', [
            'data' => $id,
        ]);
    }

    public function usul_padam($id)
    {
        $data = Usul_mesyuarat::find($id);

        $data->delete();

        // dd($data);
        return redirect()->back()->with('success', 'Usul Mesyuarat berjaya dipadam');
    }

    public function usul_tambah($id)
    {
        $usul_kategori = Usul_kategori::all();

        return view('user.usul-tambah', [
            'kategori' => $usul_kategori,
            'data' => $id,
        ]);
    }

    public function usul_simpan($id, Request $request)
    {
        $data = $request->validate([
            'usul' => 'required',
            'kategori' => 'required',

        ], [
            'usul.required' => 'Usul diperlukan.',
            'kategori.required' => 'Kategori diperlukan.',
        ]);

        // dd($date);

        $usul = Usul_mesyuarat::create([
            'usul' => $request->usul,
            'id_kategori' => $request->kategori,
            'status' => 'Belum Dijawab',
            'pengesahan' => 'Menunggu',
            'id_pengguna' => Auth::user()->id,
            'id_mesyuarat' => $id,

        ]);

        session()->flash('success', 'Usul Mesyuarat baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function usul_butiran($id)
    {

        $butiran = Ulasan_usul::join('usul_mesyuarat', 'ulasan_usul.id_usul', '=', 'usul_mesyuarat.id')
            ->join('usul_kategori', 'usul_mesyuarat.id_kategori', '=', 'usul_kategori.id')
            ->where('ulasan_usul.id_usul', $id)
            ->first();

        return view('user.usul-butiran', [
            'butiran' => $butiran,
        ]);
    }
}
