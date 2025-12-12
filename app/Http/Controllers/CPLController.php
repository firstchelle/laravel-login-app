<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CPLController extends Controller
{
    public function index()
    {
        return view('cpl.index'); // nanti buat file view ini
    }
}
