<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSumbanganController extends Controller
{
    public function index()
    {
        return view('admin.admin-sumbangan');
    }
}
