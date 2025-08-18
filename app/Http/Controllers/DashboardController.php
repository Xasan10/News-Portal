<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard(){


    $newUsers = User::with('roles')->latest()->take(10)->get();
    $users = User::all();
        
    $articles = Article::all();    
    $user = FacadesAuth::user();

    $roles = DB::table('roles')->get();

        return view('dashboard.main',['newUsers'=>$newUsers,'articles'=>$articles,'users'=>$users,'roles'=>$roles,'user'=>$user]);

    }



}
