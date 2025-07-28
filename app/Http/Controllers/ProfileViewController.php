<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileViewController extends Controller
{


    public function showProfile($id){
    
        
        $user = User::find($id);

         $articles = Article::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();


        return view('dashboard.profile',['user' => $user, 'articles'=>$articles ]);

    }

        public function loadMore(Request $request)
{
    $offset = $request->query('offset', 0);

    $articles = Article::where('user_id', auth()->id()) // or pass user_id another way
        ->orderBy('created_at', 'desc')
        ->skip($offset)
        ->take(5)
        ->get();

    return response()->json($articles);
}


    
}
