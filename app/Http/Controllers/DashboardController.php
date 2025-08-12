<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard(){


    $newUsers = User::with('roles')->latest()->take(10)->get();
    $users = User::all();
        
    $articles = Article::all();    

        return view('dashboard.main',['newUsers'=>$newUsers,'articles'=>$articles,'users'=>$users]);

    }



}
