<?php

namespace App\Http\Controllers;

use App\Models\Mesyuarat;
use App\Models\Panggilan_mesyuarat;
use App\Models\Pengguna_panggilan_mesyuarat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MesyuaratController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currentYear = now()->year;
            $user = Auth::user()->id;

            // $data = Mesyuarat::select('*', 'panggilan_mesyuarat.draf as draf', 'mesyuarat.id as id')
            //     ->leftJoin('panggilan_mesyuarat', 'mesyuarat.id', '=', 'panggilan_mesyuarat.id_mesyuarat')
            //     // ->whereYear('mesyuarat.created_at', '=', $currentYear)
            //     ->whereDate('mesyuarat.tarikh', '>=', now()->toDateString())
            //     ->get();
            $data = Pengguna_panggilan_mesyuarat::join('panggilan_mesyuarat', 'pengguna_panggilan_mesyuarat.id_panggilan', '=', 'panggilan_mesyuarat.id')
                ->join('mesyuarat', 'panggilan_mesyuarat.id_mesyuarat', '=', 'mesyuarat.id')
                ->where('pengguna_panggilan_mesyuarat.id_pengguna', $user)->get();


            // Format the date and time for each record
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
        return view('user.mesyuarat');
    }
}
