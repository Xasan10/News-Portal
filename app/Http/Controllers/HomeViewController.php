<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeViewController extends Controller
{



    public function index(): View
    {

        $articles = DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->select('articles.title', 'articles.thumbnail', 'categories.name as category_name','articles.id')
            ->orderBy('articles.created_at', 'desc')
            ->first();

  
        $bottoms = DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->select('articles.title', 'articles.thumbnail', 'categories.name as category_name', 'users.name as user_name','articles.id')
            ->orderBy('articles.created_at', 'desc')
            ->skip(1)
            ->take(3)
            ->get();

        $trending = DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->where( 'articles.created_at', '>=', now()->subDays(7))
            ->orderByDesc('articles.views')
            ->select('articles.title', 'categories.name as category_name', 'articles.created_at','articles.id')
            ->paginate(5);

      
        $right = DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->select('articles.title', 'articles.thumbnail', 'categories.name as category_name', 'users.name as user_name','articles.id')
            ->orderBy('articles.created_at', 'desc')
            ->skip(5)
            ->take(5)
            ->get();
        $filteredArticles = DB::table('articles')
    ->join('categories', 'articles.category_id', '=', 'categories.id')
    ->select('articles.title', 'categories.name as category_name', 'articles.created_at','articles.id')
    ->orderBy('articles.created_at', 'desc')
    ->take(4)
    ->get();

  
      
        $categories = Category::all();

        // ✅ Always return the view at the end
        return view('index', [
            'articles' => $articles,
            'bottoms' => $bottoms,
            'trending' => $trending,
            'right' => $right,
            'categories' => $categories,
            'filteredArticles'=>$filteredArticles
         
        ]);
    }
    
    public function ajaxFilteredArticles($slug)
{
    if ($slug === 'all') {
        $filteredArticles = DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->select('articles.title', 'categories.name as category_name', 'articles.created_at','articles.id')
            ->orderBy('articles.created_at', 'desc')
            ->take(4)
            ->get();
    } else {
        $category = Category::where('slug', $slug)->first();
        $filteredArticles = $category
            ? DB::table('articles')
                ->join('categories', 'articles.category_id', '=', 'categories.id')
                ->where('articles.category_id', $category->id)
                ->select('articles.title', 'categories.name as category_name', 'articles.created_at','articles.id')
                ->orderBy('articles.created_at', 'desc')
                ->take(4)
                ->get()
            : collect();
    }

    return view('partials.filtered-articles', ['filteredArticles' => $filteredArticles,]);
}




}
