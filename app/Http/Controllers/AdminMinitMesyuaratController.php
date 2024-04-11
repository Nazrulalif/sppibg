<?php

namespace App\Http\Controllers;

use App\Models\Minit_mesyuarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMinitMesyuaratController extends Controller
{
    public function index()
    {
        return view('admin.admin-minit-mesyuarat');
    }

    public function minit_simpan(Request $request, $id)
    {
        $request->validate([
            'file' => 'required',

        ]);

        $file = $request->file('file');

        // Generate a unique filename to prevent path traversal
        $fileName = time() . '_' .  $file->getClientOriginalExtension();

        // Store the file in a directory and get its path
        $filePath = $file->storeAs($fileName);
        $file->move(public_path('uploads/minit-mesyuarat'), $fileName);


        Minit_mesyuarat::create([
            'fail' => $filePath,
            'id_mesyuarat' => $id,
        ]);
        return redirect()->back()->with('success', 'Minit Mesyuarat berjaya disimpan');
    }

    public function minit_padam(Request $request, $id)
    {
        // Retrieve the filename from the request
        // $fileName = $request->input('file');

        $data = Minit_mesyuarat::where('id_mesyuarat', $id);

        $data->delete();

        return redirect()->back()->with('success', 'Minit Mesyuarat berjaya dipadam');
    }
}
