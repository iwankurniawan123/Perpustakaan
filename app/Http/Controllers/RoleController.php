<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function adminDashboard() {
        return view('partials.admin_dashboard');
    }

    public function mahasiswaDashboard() {
        return view('partials.mahasiswa_dashboard');
    }

}
