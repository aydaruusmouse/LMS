<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        return view('backend.admin.account.deposit_history');
    }

    public function create()
    {
        return view('backend.admin.account.create_deposit');
    }

    public function store(Request $request)
    {
        //
    }
}
