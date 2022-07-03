<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->has('type') ? 'App\Exports'.$request->get('type') : 'App\Exports\PelangganExport';
    }
}
