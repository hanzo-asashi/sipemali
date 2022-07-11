<?php

namespace App\Http\Controllers\Account;

use App\Concerns\Authorizable;
use App\Http\Controllers\Controller;

class HakAksesController extends Controller
{
    use Authorizable;

    public function index()
    {
        return view('account.roles.index');
    }
}
