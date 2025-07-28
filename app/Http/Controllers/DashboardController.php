<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard(){


    $users = User::with('roles')->latest()->take(10)->get();
        


        return view('dashboard.main',['users'=>$users]);

    }



}
