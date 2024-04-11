<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Kalendar;
use App\Models\Mesyuarat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminKalendarAcaraController extends Controller
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

        return view('admin.admin-kalendar-acara', ['upcomingEvents' => $upcomingEvents], compact('events'));
    }

    public function kalendar_laporan()
    {
        $activities = []; // Initialize an empty array or collection
        return view('admin.admin-laporan-kalendar', [
            'activities' => $activities,
        ]);
    }

    public function kalendar_laporan_tarikh(Request $request)
    {
        $data = $request->validate([
            'tarikh_mula' => 'required',
            'tarikh_akhir' => 'required',

        ]);


        $tarikh_mula = $request->tarikh_mula;
        $tarikh_akhir = $request->tarikh_akhir;
        $activities = DB::table('acara')
            ->select('id', 'tarikh', 'nama_acara as nama', 'kepada', 'tempat', 'masa_mula', 'masa_tamat')
            ->whereBetween('tarikh', [$tarikh_mula, $tarikh_akhir])
            ->union(DB::table('mesyuarat')
                ->select('id', 'tarikh', 'nama_mesyuarat as nama', 'kepada', 'tempat', 'masa_mula', 'masa_tamat')
                ->whereBetween('tarikh', [$tarikh_mula, $tarikh_akhir]))
            ->orderBy('tarikh')
            ->get();

        $formatted_date1 = Carbon::parse($tarikh_mula)->format('j F Y');
        $formatted_date2 = Carbon::parse($tarikh_akhir)->format('j F Y');

        return view('admin.admin-laporan-kalendar', [
            'activities' => $activities,
            'tarikh_mula' => $formatted_date1,
            'tarikh_akhir' => $formatted_date2,
        ]);
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

    public function kalendar_delete($id)
    {
        $acara = Acara::find($id);
        $mesyuarat = Mesyuarat::find($id);

        $event = $acara ? $acara : $mesyuarat;
        $event->delete();

        session()->flash('success', 'Acara berjaya dipadam');
        echo '<script>window.opener.location.reload(); window.close();</script>';
        // return redirect()->back();
    }

    public function kalendar_delete_upcomming($id)
    {
        $acara = Acara::find($id);
        $mesyuarat = Mesyuarat::find($id);

        $event = $acara ? $acara : $mesyuarat;
        $event->delete();

        session()->flash('success', 'Acara berjaya dipadam');
        // echo '<script>window.opener.location.reload(); window.close();</script>';
        return redirect()->back();
    }

    public function kalendar_edit($id)
    {
        $acara = Acara::find($id);
        $mesyuarat = Mesyuarat::find($id);

        $event = $acara ? $acara : $mesyuarat;
        return view('admin.admin-edit-kalendar', [
            'data' => $event,
        ]);
    }

    public function kalendar_update($id)
    {
        $acara = Acara::find($id);
        $mesyuarat = Mesyuarat::find($id);

        // Assuming $acara and $mesyuarat are found, update their attributes
        if ($acara) {
            $acara->update([
                'nama_acara' => request('nama_acara'),
                // 'tarikh' => request('tarikh'),
                'masa_mula' => request('masa_mula'),
                'masa_tamat' => request('masa_tamat'),
                'kepada' => request('kepada'),
                'tempat' => request('tempat'),
                'agenda' => request('agenda'),
                'warna' => request('warna'),
            ]);
        }

        if ($mesyuarat) {
            $mesyuarat->update([
                'nama_mesyuarat' => request('nama_mesyuarat'),
                // 'tarikh' => request('tarikh'),
                'masa_mula' => request('masa_mula'),
                'masa_tamat' => request('masa_tamat'),
                'kepada' => request('kepada'),
                'tempat' => request('tempat'),
                'agenda' => request('agenda'),
                'warna' => request('warna'),
            ]);
        }

        // Redirect back to the previous page or wherever you need to go
        session()->flash('success', 'Kalendar berjaya dikemaskini');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function kalendar_tambah($date)
    {
        // dd($date);

        $formatted_date = Carbon::parse($date)->format('d/m/Y');
        // dd($formatted_date);

        return view('admin.admin-tambah-kalendar', [
            'date' => $date,
            'formatted_date' => $formatted_date,
        ]);
    }


    public function acara_simpan(Request $request, $date)
    {
        $data = $request->validate([
            'nama_acara' => 'required',
            'masa_mula' => 'required',
            'masa_tamat' => 'required',
            'tempat' => 'required',
            'agenda' => 'required',
        ]);

        // dd($date);

        $acara = Acara::create([
            'tarikh' => $date,
            'warna' => $request->warna,
            'nama_acara' => $request->nama_acara,
            'masa_mula' => $request->masa_mula,
            'masa_tamat' => $request->masa_tamat,
            'kepada' => $request->kepada,
            'tempat' => $request->tempat,
            'agenda' => $request->agenda,
        ]);

        // $kalendar = Kalendar::create([
        //     'id_acara' => $acara->id,
        //     'warna' => '#28a745',
        // ]);

        session()->flash('success', 'Acara baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function mesyuarat_simpan(Request $request, $date)
    {
        $data = $request->validate([
            'nama_mesyuarat' => 'required',
            'masa_mula' => 'required',
            'masa_tamat' => 'required',
            'tempat' => 'required',
            'agenda' => 'required',
        ]);

        // dd($date);

        $acara = Mesyuarat::create([
            'tarikh' => $date,
            'warna' => $request->warna,
            'nama_mesyuarat' => $request->nama_mesyuarat,
            'masa_mula' => $request->masa_mula,
            'masa_tamat' => $request->masa_tamat,
            'kepada' => $request->kepada,
            'tempat' => $request->tempat,
            'agenda' => $request->agenda,
        ]);

        // $kalendar = Kalendar::create([
        //     'id_acara' => $acara->id,
        //     'warna' => '#28a745',
        // ]);

        session()->flash('success', 'Mesyuarat baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }
}
