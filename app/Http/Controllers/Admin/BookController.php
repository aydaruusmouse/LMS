<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        return view('backend.admin.book.index');
    }
}
