<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminRekodKehadiranController extends Controller
{
    public function index()
    {
        return view('admin.admin-rekod-kehadiran');
    }
}
