<?php

namespace App\Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin::home.index');
    }
}
