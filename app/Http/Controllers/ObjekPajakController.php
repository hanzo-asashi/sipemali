<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjekPajakController extends Controller
{
    public function index()
    {
        return view('objek-pajak.index');
    }

    public function create()
    {
        $updateMode = false;
        $id = null;
        return view('objek-pajak.create', compact('updateMode','id'));
    }

    public function show($id)
    {
        return view('objek-pajak.detail', compact('id'));
    }

    public function edit($id, Request $request)
    {
        $updateMode = $request->get('um');
        return view('objek-pajak.create',compact('id','updateMode'));
    }
}
