<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Traits\Authorizable;

class HakAksesController extends Controller
{
    use Authorizable;
    public function index()
    {
        return view('account.roles.index');
    }
}
