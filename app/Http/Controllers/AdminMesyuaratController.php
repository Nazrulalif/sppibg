<?php

namespace App\Http\Controllers;

use App\Models\Akses_pengguna;
use App\Models\Mesyuarat;
use App\Models\Minit_mesyuarat;
use App\Models\Panggilan_mesyuarat;
use App\Models\Pengguna_panggilan_mesyuarat;
use App\Models\User;
use App\Models\Usul_mesyuarat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminMesyuaratController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currentYear = now()->year;

            $data = Mesyuarat::select('*', 'panggilan_mesyuarat.draf as draf', 'mesyuarat.id as id')
                ->leftJoin('panggilan_mesyuarat', 'mesyuarat.id', '=', 'panggilan_mesyuarat.id_mesyuarat')
                // ->whereYear('mesyuarat.created_at', '=', $currentYear)
                ->whereDate('mesyuarat.tarikh', '>=', now()->toDateString())
                ->get();


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

        return view('admin.admin-mesyuarat');
    }

    public function mesyuarat_butiran($id)
    {
        $data = Mesyuarat::find($id);
        $panggilan = Panggilan_mesyuarat::join('mesyuarat', 'mesyuarat.id', '=', 'panggilan_mesyuarat.id_mesyuarat')
            ->where('mesyuarat.id', $id)
            ->first();

        $usul = Usul_mesyuarat::where('id_mesyuarat', $id)->get();

        $formatted_date = Carbon::parse($data->tarikh)->format('l, j F Y');
        $user_role = Akses_pengguna::where('id', '!=', '1')->get();

        $count = Usul_mesyuarat::where('id_mesyuarat', $id)
            ->where('pengesahan', '=', 'Menunggu')
            ->count();

        $minit_mesyuarat = Minit_mesyuarat::select('*', 'fail as fail')
            ->where('id_mesyuarat', $id)
            ->get();

        $minit_fail = Minit_mesyuarat::select('*', 'fail as fail')
            ->where('id_mesyuarat', $id)
            ->first();

        // dd($minit_fail->fail);

        return view('admin.admin-butiran-mesyuarat', [
            'data' => $data,
            'usul' => $usul,
            'panggilan' => $panggilan,
            'formatted_date' => $formatted_date,
            'role' => $user_role,
            'count' => $count,
            'minit_mesyuarat' => $minit_mesyuarat,
            'minit_fail' => $minit_fail,
        ]);
    }

    public function mesyuarat_arkib(Request $request)
    {
        if ($request->ajax()) {
            $currentYear = now()->year;

            $data = Mesyuarat::select('*', 'panggilan_mesyuarat.draf as draf', 'mesyuarat.id as id')
                ->leftJoin('panggilan_mesyuarat', 'mesyuarat.id', '=', 'panggilan_mesyuarat.id_mesyuarat')
                // ->whereYear('mesyuarat.created_at', '!=', $currentYear)
                ->whereDate('mesyuarat.tarikh', '<=', now()->toDateString())

                ->get();

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

        return view('admin.admin-mesyuarat');
    }

    public function panggilan_mesyuarat_surat($id)
    {
        // $mesyuarat = Mesyuarat::find($id);

        $mesyuarat = Mesyuarat::select('*', 'panggilan_mesyuarat.draf as draf', 'mesyuarat.id as id', 'panggilan_mesyuarat.id as id_panggilan')
            ->leftjoin('panggilan_mesyuarat', 'mesyuarat.id', '=', 'panggilan_mesyuarat.id_mesyuarat')
            ->where('mesyuarat.id', $id)
            ->first();

        $penggunaPanggilan = Pengguna_panggilan_mesyuarat::where('id_panggilan', $mesyuarat->id_panggilan)
            ->get();

        $displayedRoles = [];
        foreach ($penggunaPanggilan as $item) {
            $user = User::find($item->id_pengguna);

            // Check if $user is not null before accessing its properties
            if ($user !== null) {
                $role = Akses_pengguna::find($user->access_code);
                if ($role !== null) {
                    // var_dump($role->nama_akses);

                    if (!in_array($role->nama_akses, $displayedRoles)) {
                        // var_dump($role->nama_akses);
                        // Add role to the displayed roles array
                        $displayedRoles[] = $role->nama_akses;
                    }
                }
            }
        }




        // Continue with your existing code to fetch the agenda and display the view
        $listItems = explode("\n", $mesyuarat->agenda);

        return view('admin.admin-surat-panggilan-mesyuarat', [
            'data' => $mesyuarat,
            'listItems' => $listItems,
            'userRole' => $displayedRoles,
        ]);
    }

    public function mesyuarat_tambah()
    {
        return view('admin.admin-tambah-mesyuarat');
    }

    public function mesyuarat_simpan(Request $request)
    {
        $data = $request->validate([
            'nama_mesyuarat' => 'required',
            'masa_mula' => 'required',
            'masa_tamat' => 'required',
            'tempat' => 'required',
            'agenda' => 'required',
            'tarikh' => 'required',
        ]);

        // dd($date);

        $mesyuarat = Mesyuarat::create([
            'tarikh' => $request->tarikh,
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

        session()->flash('success', 'Acara baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function mesyuarat_padam($id)
    {

        $data = Mesyuarat::find($id);

        $data->delete();

        // dd($data);
        return redirect()->back()->with('success', 'Mesyuarat berjaya dipadam');
    }

    public function mesyuarat_edit($id)
    {
        $data = Mesyuarat::find($id);
        return view('admin.admin-edit-mesyuarat', [
            'data' => $data,
        ]);
    }

    public function mesyuarat_update($id)
    {
        $mesyuarat = Mesyuarat::find($id);

        $mesyuarat->update([
            'nama_mesyuarat' => request('nama_mesyuarat'),
            'tarikh' => request('tarikh'),
            'masa_mula' => request('masa_mula'),
            'masa_tamat' => request('masa_tamat'),
            'kepada' => request('kepada'),
            'tempat' => request('tempat'),
            'agenda' => request('agenda'),
            'warna' => request('warna'),
        ]);

        session()->flash('success', 'Mesyuarat berjaya dikemaskini');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }


    public function panggilan_mesyuarat_butiran($id)
    {
        $data = Mesyuarat::find($id);

        $formatted_date = Carbon::parse($data->tarikh)->format('l, j F Y');
        $user_role = Akses_pengguna::where('id', '!=', '1')->get();


        return view('admin.admin-butiran-mesyuarat', [
            'data' => $data,
            'formatted_date' => $formatted_date,
            'role' => $user_role,
        ]);
    }

    public function panggilan_mesyuarat_simpan($id, Request $request)
    {

        // dd($id);
        $validatedData = $request->validate([
            'nama_panggilan' => 'required|string',
            'kepada' => 'required|array',
            // 'file' => 'required',
            // 'kepada' will be an array of role IDs
            // 'id_mesyuarat' => 'required|exists:mesyuarat,id'
        ]);

        // // Retrieve the file for each iteration
        $file = $request->file('file');

        // Generate a unique filename to prevent path traversal
        $fileName = time() . '_' .  $file->getClientOriginalExtension();

        // Store the file in a directory and get its path
        $filePath = $file->storeAs($fileName);
        $file->move(public_path('uploads/tandatangan'), $fileName);

        // $id_draf = ($request->submit === '1') ? '1' : '2';


        // Create a new meeting invitation
        $invitation = Panggilan_mesyuarat::create([
            'nama_panggilan' => $validatedData['nama_panggilan'],
            'id_mesyuarat' => $id,
            'tandatangan' => $filePath,
            'draf' => 2
        ]);

        // $mesyuarat = Mesyuarat::find($id);

        // $mesyuarat->update([
        //     'panggilan_status' => '2',
        // ]);


        // Invite users based on their selected roles
        foreach ($validatedData['kepada'] as $roleId) {
            $users = User::where('access_code', $roleId)->get();
            // dd($users);

            foreach ($users as $user) {
                Pengguna_panggilan_mesyuarat::create([
                    'id_pengguna' => $user->id,
                    'id_panggilan' => $invitation->id
                ]);
            }
        }

        return redirect()->route('admin.panggilan-mesyuarat');
    }
}
