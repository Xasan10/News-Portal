<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class DetailsViewController extends Controller
{
    
   public function view($id)
{
    $article = Article::findOrFail($id);

    // Eager-load users with comments
    $comments = Comment::where('article_id', $article->id)
                       ->with('user')
                       ->get();

    return view('details', [
        'data' => $article,
        'comments' => $comments
    ]);
}


}
