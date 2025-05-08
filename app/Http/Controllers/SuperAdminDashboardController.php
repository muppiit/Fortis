<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        return view('super-admin.dashboard', [
            'nama' => Session::get('admin_nama'),
            'role' => Session::get('admin_role'),
        ]);
    }
}
