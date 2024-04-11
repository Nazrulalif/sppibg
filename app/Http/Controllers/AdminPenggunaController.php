<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminPenggunaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::select('*', 'users.id as id')
                ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
                ->where('users.id', '!=', auth()->user()->id)
                ->where('users.verified', '!=', '2')
                ->get(); // Include the 'id' column here

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $count = User::join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            ->where('users.id', '!=', auth()->user()->id)
            ->where('users.verified', '=', 2)
            ->count();

        return view('admin.admin-pengguna', ['count' => $count]);
    }

    public function pengguna_butiran($id)
    {
        $data = User::select('*', 'users.id as id', 'users.hubungan')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            ->where('users.id', $id)
            ->first(); // Include the 'id' column here

        $pelajar = Pelajar::join('users', 'pelajar.id_pengguna', '=', 'users.id')
            ->where('pelajar.id_pengguna', $id)
            ->get();

        return view('admin.admin-butiran-pengguna', [
            'user' => $data,
            'pelajar' => $pelajar
        ]);
    }

    public function belum_sah_pengguna(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select('*', 'users.id as id', 'users.created_at')
                ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
                ->where('users.id', '!=', auth()->user()->id)
                ->where('users.verified', '=', '2')
                ->get(); // Include the 'id' column here

            foreach ($data as $item) {
                $item->formatted_date = Carbon::parse($item->created_at)->format('j F Y');
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }




        return view('admin.admin-pengguna');
    }

    public function pengguna_sah(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak dijumpai');
        }

        $user->verified = 1;
        $user->save();


        return redirect()->back()->with('success', 'Pengguna berjaya di sahkan');
    }

    public function pengguna_tambah()
    {
        return view('admin.admin-tambah-pengguna');
    }

    public function pengguna_simpan(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'akses' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'no_ic' => $request->ic,
            'email' => $request->email,
            'no_phone' => $request->phone,
            'address' => $request->address,
            'access_code' => $request->akses,
            'hubungan' => $request->hubungan,
            'verified' => 1,
            'password' => Hash::make($request->password),
        ]);

        // Store child details associated with the user
        if ($user) {
            foreach ($request->child as $index => $childName) {
                // Create Pelajar (student) associated with the User
                Pelajar::create([
                    'id_pengguna' => $user->id,
                    // 'hubungan' => $request->hubungan,

                    'nama_pelajar' => $childName, // Access each child's name by index
                    'kelas' => $request->class[$index], // Access each class by index

                ]);
            }
        }
        session()->flash('success', 'Pengguna baharu berjaya ditambah');
        echo '<script>window.opener.location.reload(); window.close();</script>';
    }

    public function pengguna_padam($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak wujud');
        }

        $pelajar = Pelajar::where('id_pengguna', $id)->first();

        echo ($pelajar);

        if ($pelajar) {
            $pelajar->delete();
        }

        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berjaya di padam');
    }

    public function pengguna_edit()
    {
        $user = User::select('*', 'users.name as name', 'users.id as id',)
            ->join('pelajar', 'users.id', '=', 'pelajar.id_pengguna')
            ->join('akses_pengguna', 'users.access_code', '=', 'akses_pengguna.id')
            // ->where('users.id', '!=', Auth()->user()->id)
            ->first();
        $pelajar = Pelajar::select('*', 'pelajar.id as pelajarId', 'pelajar.id_pengguna as id_pengguna')
            ->join('users', 'users.id', '=', 'pelajar.id_pengguna')
            ->get();

        return view('admin.admin-edit-pengguna', [
            'user' => $user,
            'pelajar' => $pelajar,
        ]);
    }

    public function pelajar_delete($id)
    {
        $pelajar = Pelajar::find($id);

        $pelajar->delete();

        return redirect()->back()->with('success', 'Pelajar berjaya di padam');
    }

    public function pengguna_update(Request $request, User $id)
    {
        $id->name = $request->name;
        $id->no_ic = $request->ic;
        $id->no_phone = $request->phone;
        $id->address = $request->address;
        $id->email = $request->email;
        $id->access_code = $request->akses;
        $id->hubungan = $request->hubungan;
        // $id->access_code = $request->access_code;
        $id->save();

        // Delete existing child records if no child data is provided
        if (empty($request->child)) {
            Pelajar::where('id_pengguna', $id->id)->delete();
        } else {
            // Delete existing child records and store new child details associated with the user
            Pelajar::where('id_pengguna', $id->id)->delete();

            foreach ($request->child as $index => $childName) {
                // Create Pelajar (student) associated with the User
                Pelajar::create([
                    'id_pengguna' => $id->id,
                    // 'hubungan' => $request->hubungan,
                    'nama_pelajar' => $childName, // Access each child's name by index
                    'kelas' => $request->class[$index], // Access each class by index
                ]);
            }
        }
        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berjaya di padam');
    }
}