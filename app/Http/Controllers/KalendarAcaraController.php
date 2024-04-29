<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Mesyuarat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KalendarAcaraController extends Controller
{
    public function index()
    {
        $acaraEvents = Acara::all();
        $mesyuaratEvents = Mesyuarat::all();

        $events = $acaraEvents->merge($mesyuaratEvents);

        $current_date = Carbon::now()->format('Y-m-d');


        $upcomingEvents = $acaraEvents->merge($mesyuaratEvents)
            ->where('tarikh', '>=', $current_date)
            ->sortBy('tarikh');

        return view('user.kalendar-acara', ['upcomingEvents' => $upcomingEvents], compact('events'));
    }

    public function kalendar_butiran($id)
    {
        $acara = Acara::find($id);
        $mesyuarat = Mesyuarat::find($id);

        $event = $acara ? $acara : $mesyuarat;

        $formatted_date = Carbon::parse($event->tarikh)->format('l, j F Y');

        return view('admin.admin-butiran-kalendar', [
            'data' => $event,
            'formatted_date' => $formatted_date,
        ]);
    }
}
