<?php

namespace App\Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IconController extends Controller
{
    public function index()
    {
        return view('admin::admin.icon.index');
    }
}
