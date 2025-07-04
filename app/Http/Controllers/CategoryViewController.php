<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class CategoryViewController extends Controller
{
    public function index():ViewView{


        $filteredArticles  = DB::table('articles')->join('categories', 'articles.id', '=', 'categories.id')
                                                        ->select('articles.title','articles.body','categories.name as category_name','articles.id')
                                                        ->paginate(4);


        $categories = Category::all();



        return view('category',['categories'=>$categories,'filteredArticles' =>$filteredArticles]);
        






    }
     public function filteredArticles($slug)
{
    if ($slug === 'all') {
        $filteredArticles = DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id',)
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
