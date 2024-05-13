<?php

namespace App\Http\Controllers;

use App\Models\Buletin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminLamanUtamaController extends Controller
{
    public function index(Request $request)
    {
        $user = User::select('*', 'users.id as id')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id',)
            ->where('users.access_code', Auth::user()->access_code)
            ->first();

        if ($request->ajax()) {
            $currentYear = now()->year;

            $data = Buletin::select('id', 'nama_buletin', 'penerangan', 'id_draf', 'fail')
                ->whereYear('created_at', $currentYear)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }


        return view('admin.admin-halaman-utama', [
            'user' => $user,
        ]);
    }

    public function arkib(Request $request)
    {
        $user = User::select('*')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            ->first();

        if ($request->ajax()) {
            $currentYear = now()->year;

            $data = Buletin::select('id', 'nama_buletin', 'penerangan', 'id_draf', 'fail')
                ->whereYear('created_at', '!=', $currentYear)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.admin-halaman-utama', [
            'user' => $user,
        ]);
    }

    public function profil_edit()
    {
        $user = User::select('*', 'users.id as id')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            ->first();

        return view('admin.admin-borang-profil', [
            'user' => $user,
        ]);
    }

    public function profil_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email',

        ], [
            'name.required' => 'Nama diperlukan.',
            'ic.required' => 'Nombor kad Pengenalan diperlukan.',
            'phone.required' => 'Nombor telefon diperlukan',
            'address.required' => 'Alamat diperlukan',
            'email.required' => 'Emel diperlukan',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->no_ic = $request->ic;
        $user->no_phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.laman-utama')->with('success', 'Maklumat profil berjaya dikemas kini');
    }


    public function buletin_tambah()
    {

        return view('admin.admin-tambah-buletin');
    }

    public function buletin_simpan(Request $request)
    {
        $request->validate([
            'buletin_name' => 'required',
            'penerangan' => 'required',
            'file' => 'required',

        ], [
            'buletin_name.required' => 'Tajuk diperlukan.',
            'penerangan.required' => 'Penerangan diperlukan.',
            'file.required' => 'Sila pilih fail',
        ]);

        // // Retrieve the file for each iteration
        $file = $request->file('file');

        // Generate a unique filename to prevent path traversal
        $fileName = time() . '_' .  $file->getClientOriginalExtension();

        // Store the file in a directory and get its path
        $filePath = $file->storeAs($fileName);
        $file->move(public_path('uploads/buletin'), $fileName);

        $id_draf = ($request->submit === '1') ? '1' : '2';

        // $id_draf = $request->submit;

        // dd($id_draf);

        Buletin::create([
            'nama_buletin' => $request->buletin_name,
            'penerangan' => $request->penerangan,
            'fail' => $filePath,
            'id_draf' => $id_draf,
        ]);


        session()->flash('success', 'Buletin baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function buletin_padam($id)
    {
        $buletin = Buletin::find($id);

        $buletin->delete();

        return redirect()->back()->with('success', 'Buletin berjaya di padam');
    }

    public function buletin_edit($id, Request $request)
    {
        $data = Buletin::find($id);

        return view('admin.admin-edit-buletin', ['data' => $data]);
    }

    public function buletin_update($id, Request $request)
    {
        $request->validate([
            'buletin_name' => 'required',
            'penerangan' => 'required',

        ], [
            'buletin_name.required' => 'Tajuk diperlukan.',
            'penerangan.required' => 'Penerangan diperlukan.',
        ]);

        $data = Buletin::findOrFail($id);

        $data->fill([
            'nama_buletin' => $request->buletin_name,
            'penerangan' => $request->penerangan,
            'id_draf' => $request->submit === '1' ? '1' : '2',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Validate the file if needed

            $fileName = time() . '_' .  $file->getClientOriginalExtension();

            // Store the file in a directory and get its path
            $filePath = $file->storeAs($fileName);
            $file->move(public_path('uploads/buletin'), $fileName);

            // Update the file path in the model
            $data->fail = $filePath;
        }

        $data->save();

        session()->flash('success', 'Buletin berjaya dikemaskini');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }
}
