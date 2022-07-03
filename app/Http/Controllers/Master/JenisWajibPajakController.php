<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;

class JenisWajibPajakController extends Controller
{
    public function index()
    {
        return view('master.jenis-pajak.index');
    }
}
