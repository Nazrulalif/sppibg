<?php

namespace App\Http\Controllers;

use App\Models\Minit_mesyuarat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MinitMesyuaratController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currentYear = now()->year;
            // $user = Auth::user()->id;

            $data = Minit_mesyuarat::join('mesyuarat', 'minit_mesyuarat.id_mesyuarat', '=', 'mesyuarat.id')->get();


            // Format the date and time for each record
            $formatted_data = $data->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->created_at)->format('j F Y');

                return $item;
            });

            return DataTables::of($formatted_data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('user.minit-mesyuarat');
    }
}
