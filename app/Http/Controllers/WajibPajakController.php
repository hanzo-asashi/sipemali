<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WajibPajakController extends Controller
{
    public function index()
    {
        return view('wajib-pajak.index');
    }

    public function create()
    {
        $updateMode = false;
        $id = null;
        return view('wajib-pajak.create', compact('updateMode','id'));
    }

    public function show($id)
    {
        return view('wajib-pajak.detail', compact('id'));
    }
    public function edit($id, Request $request)
    {
        $updateMode = $request->get('um');
        return view('wajib-pajak.create',compact('updateMode','id'));
    }

}
