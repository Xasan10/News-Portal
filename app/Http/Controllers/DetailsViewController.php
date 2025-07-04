<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DetailsViewController extends Controller
{
    
    public function view($id){

        $id = Article::findOrFail($id);



        return view('details',['data'=>$id]);
    }


}
