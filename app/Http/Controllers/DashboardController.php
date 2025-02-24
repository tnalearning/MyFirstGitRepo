<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // User & Agent Dashboard
    public function userDashboard()
    {
        return view('user.dashboard');
    }

    // Admin Dashboard
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    // Super Admin Dashboard
    public function superAdminDashboard()
    {
        return view('superadmin.dashboard');
    }

}
