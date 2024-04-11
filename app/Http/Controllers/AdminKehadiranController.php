<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminKehadiranController extends Controller
{
    public function index()
    {
        return view('admin.admin-kehadiran');
    }
}
