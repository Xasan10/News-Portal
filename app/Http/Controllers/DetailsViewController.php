<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DetailsViewController extends Controller
{
    
    public function view($id){

        $article = Article::findOrFail($id);



        return view('details',['data'=>$article]);
    }


}
