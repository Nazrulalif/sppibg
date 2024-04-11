<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAduanCadanganController extends Controller
{
    public function index()
    {
        return view('admin.admin-aduan-cadangan');
    }
}
