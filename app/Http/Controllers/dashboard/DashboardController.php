<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $adminCount = User::where('user_type', 'admin')->count();
        $trainerCount = User::where('user_type', 'trainer')->count();
        $customerCount = User::where('user_type', 'customer')->count();
        
        return view('dashboard.pages.home', compact('adminCount', 'trainerCount', 'customerCount'));
    }
}
