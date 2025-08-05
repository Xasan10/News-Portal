<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostViewController extends Controller
{
    

    public function viewCreateArticles(){


        $categories = Category::all(); 

        $articles = DB::table('articles')
        ->join('categories', 'articles.category_id', "=", 'categories.id' )
        ->join('users','articles.user_id','=','users.id')
        ->select('categories.name as category_name', 'articles.title', 'articles.updated_at', 'articles.id as article_id','users.name as author')
        ->orderBy('articles.updated_at','desc')->get();


        return view('dashboard.createpost',['categories'=>$categories,'articles' => $articles]);



    }



    public function store(Request $request){


    try {
      $validated = $request->validate([

            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => '',
            'category_id'=>'required|integer|exists:categories,id',
            'thumbnail' =>  'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'


        ]);


        $thumbnail = $request->file('thumbnail')->store('thumbnails','public');


        Article::create([


            'title'=> $validated['title'],
            'body'=> $validated['body'],
            'user_id' => auth()->id(),
            'category_id'=>$validated['category_id'],
            'thumbnail' => $thumbnail,
            'view' => 0



        ]);

            return redirect()->route('create')->with('success', 'Article created!');

    } catch (\Throwable $e) {
            Log::error($e->getMessage());
    return redirect()->back()->withErrors('Something went wrong');
    }

   







    }



}
