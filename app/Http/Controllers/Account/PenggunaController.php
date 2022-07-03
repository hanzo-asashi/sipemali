<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Traits\Authorizable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class PenggunaController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('account.pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('account.pengguna.create', [
            'updateMode' => false,
            'id'         => null,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('account.pengguna.create', [
            'updateMode' => true,
            'id'         => $id,
        ]);
    }
}
