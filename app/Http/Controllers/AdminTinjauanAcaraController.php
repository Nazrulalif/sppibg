<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTinjauanAcaraController extends Controller
{
    public function index()
    {
        return view('admin.admin-tinjauan-acara');
    }
}
