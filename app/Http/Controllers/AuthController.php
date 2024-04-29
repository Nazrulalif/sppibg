<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('admin.laman-utama'));
        }
        return view('session/login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->verified == 1) {
                if ($user->access_code == 1 || $user->access_code == 2 || $user->access_code == 3 || $user->access_code == 6) {
                    return redirect()->intended(route('admin.laman-utama'))->with("success", "Log masuk berjaya");
                } else {
                    return redirect()->intended(route('laman-utama'))->with("success", "Log Masuk Berjaya");
                }
            } else {
                Auth::logout();
                return redirect(route('login'))->with("error", "Butiran anda belum disahkan");
            }
        }

        return redirect(route('login'))->with("error", "Butiran log masuk salah");
    }

    public function logout()
    {
        // Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function register()
    {
        return view('session.register');
    }

    public function pengguna_simpan(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'akses' => 'required',
            'password' => 'required',
        ]);

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // Email exists
            if ($existingUser->verified == 3) {
                // Update user details
                $existingUser->update([
                    'name' => $request->name,
                    'no_ic' => $request->ic,
                    'no_phone' => $request->phone,
                    'address' => $request->address,
                    'access_code' => $request->akses,
                    'hubungan' => $request->hubungan,
                    'verified' => 2, // Set verified to 1 for new user
                    'password' => Hash::make($request->password),
                ]);

                // Delete existing child records
                Pelajar::where('id_pengguna', $existingUser->id)->delete();

                // Create new child records
                foreach ($request->child as $index => $childName) {
                    if (!empty($childName) && !empty($request->class[$index])) {
                        // Create Pelajar (student) associated with the User
                        Pelajar::create([
                            'id_pengguna' => $existingUser->id,
                            'nama_pelajar' => $childName, // Access each child's name by index
                            'kelas' => $request->class[$index], // Access each class by index
                            'tahun_pelajar_id' => $request->year[$index], // Access each class by index
                        ]);
                    }
                }

                // session()->flash('success', 'Pengguna baharu berjaya ditambah');
                return redirect()->route('login')->with('success', 'Maklumat akaun ada akan disemak dan disahkan oleh pentadbir sistem');
            } else {
                // Email already exists but user is not verified
                // session()->flash('success', 'Pengguna telah pun mendaftar');
                return redirect()->route('login')->with('success', 'Anda telah pun mendaftar');
            }
        } else {
            // Create new user
            $user = User::create([
                'name' => $request->name,
                'no_ic' => $request->ic,
                'email' => $request->email,
                'no_phone' => $request->phone,
                'address' => $request->address,
                'access_code' => $request->akses,
                'hubungan' => $request->hubungan,
                'verified' => 2, // Set verified to 1 for new user
                'password' => Hash::make($request->password),
            ]);

            // Store child details associated with the user
            if ($user) {
                foreach ($request->child as $index => $childName) {
                    if (!empty($childName) && !empty($request->class[$index])) {
                        // Create Pelajar (student) associated with the User
                        Pelajar::create([
                            'id_pengguna' => $user->id,
                            'nama_pelajar' => $childName, // Access each child's name by index
                            'kelas' => $request->class[$index], // Access each class by index
                            'tahun_pelajar_id' => $request->year[$index], // Access each class by index
                        ]);
                    }
                }
            }

            return redirect()->route('login')->with('success', 'Maklumat akaun ada akan disemak dan disahkan oleh pentadbir sistem');
        }

        // session()->flash('success', 'Pengguna baharu berjaya ditambah');
        // echo '<script>window.opener.location.reload(); window.close();</script>';
        return redirect()->route('login')->with('success', 'Maklumat akaun ada akan disemak dan disahkan oleh pentadbir sistem');
    }
}
