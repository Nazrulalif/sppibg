<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Kehadiran_pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminQrReaderController extends Controller
{
    public function index()
    {
        return view('admin.admin-qr-reader');
    }

    public function qr_simpan(Request $request)
    {
        // Retrieve the scanned content from the request
        $content = $request->input('content');

        // Get the authenticated user's ID
        $user = Auth::user()->id;

        // Decode the JSON string
        $data = json_decode($content, true);

        // Check if JSON decoding was successful
        if ($data !== null) {
            // Process each JSON object in the array
            foreach ($data as $record) {
                // Extract id_kehadiran from each record
                $id_kehadiran = data_get($record, 'id');
                if (is_null($id_kehadiran)) {
                    // Handle null case (log, continue to next record)
                    continue;
                }

                // Check if the user exists in the kehadiran_pengguna table
                $userExists = Kehadiran_pengguna::where('id_pengguna', $user)
                    ->where('id_kehadiran', $id_kehadiran)
                    ->exists();

                if ($userExists) {
                    // Update the status directly in the database
                    Kehadiran_pengguna::where('id_pengguna', $user)
                        ->where('id_kehadiran', $id_kehadiran)
                        ->update(['status' => 'Hadir']);

                    // Store the updated id_kehadiran in the session
                    session()->put('qr_data', $id_kehadiran);
                    return response()->json(['message' => 'Attendance updated successfully']);
                } else {
                    return response()->json(['message' => 'User not found']);
                }
            }

            // Return a success response
            return response()->json(['message' => 'Attendance updated successfully']);
        }

        // Handle unexpected case (shouldn't reach here with proper decoding)
        return response()->json(['message' => 'Unexpected error processing QR data']);
    }

    public function qr_berjaya()
    {
        // Retrieve data from session (or flash data)
        $id_kehadiran = session()->get('qr_data');

        $mesyuarat = Kehadiran::select('*', 'mesyuarat.tarikh as tarikh')
            ->join('mesyuarat', 'kehadiran.id_mesyuarat', '=', 'mesyuarat.id')
            ->where('kehadiran.id', $id_kehadiran)
            ->first();

        $formatted_date = Carbon::parse($mesyuarat->tarikh)->format('l, j F Y');

        // Clear the session data
        // session()->forget('qr_data');
        // dd($mesyuarat);
        return view('admin.admin-qr-berjaya', [
            'data' => $mesyuarat,
            'formatted_date' => $formatted_date,
        ]);
    }
}
