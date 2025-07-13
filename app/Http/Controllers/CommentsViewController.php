<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsViewController extends Controller
{
    

public function store(Request $request)
{
    $request->validate([
        'content' => 'required|max:1000',
        'article_id' => 'required|exists:articles,id', // ✅ correct validation
    ]);

    Comment::create([
        'content' => $request->content,
        'user_id' => auth()->id(),
        'article_id' => $request->article_id,
    ]);

    return back()->with('success', 'Comment posted!');
}


}