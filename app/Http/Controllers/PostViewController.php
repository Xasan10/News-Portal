<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostViewController extends Controller
{
    

    public function viewCreateArticles(){


        $categories = Category::all(); 

        $user = Auth::user();

        if ($user->hasAnyRole(['admin','editor'])) {
                    $articles = DB::table('articles')
        ->join('categories', 'articles.category_id', "=", 'categories.id' )
        ->join('users','articles.user_id','=','users.id')
        ->select('categories.name as category_name', 'articles.title', 'articles.updated_at', 'articles.id as article_id','users.name as author')
        ->orderBy('articles.updated_at','desc')->get();
        }else{

            $articles = DB::table('articles')
                ->join('categories', 'articles.category_id', '=', 'categories.id')
                ->join('users', 'articles.user_id', '=', 'users.id')
                ->select(
                    'categories.name as category_name',
                    'articles.title',
                    'articles.updated_at',
                    'articles.id as article_id',
                    'users.name as author'
                )
                ->orderBy('articles.updated_at', 'desc')
                ->where('user_id', $user->id)
                ->get();


        }






        return view('dashboard.createpost',['categories'=>$categories,'articles' => $articles,'user'=>$user]);



    }



  public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Article::create([
            'title'       => $validated['title'],
            'body'        => $validated['body'],
            'user_id'     => auth()->id(),
            'category_id' => $validated['category_id'],
            'thumbnail'   => $thumbnail,
            'view'        => 0
        ]);

        return redirect()->route('createpost')->with('success', 'Article created!');
    } catch (\Throwable $e) {
        Log::error($e->getMessage());
        return redirect()->back()->withErrors('Something went wrong');
    }
}

public function destroy($id)
{
    $article = Article::findOrFail($id);
    $article->delete();

    return redirect()->back()->with('success', 'Article deleted successfully!');
}

   


public function updateView($id){


    $article = Article::findOrFail($id);


    $categories = Category::all();

    return view('dashboard.update',['categories'=>$categories,'article'=>$article]);





}
 public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);

    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'category_id' => 'required|exists:categories,id'
    ]);

  if ($request->hasFile('thumbnail')) {
    // Delete old image if exists
    if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
        Storage::disk('public')->delete($article->thumbnail);
    }

    // Upload new image to storage/app/public/uploads
    $imagePath = $request->file('thumbnail')->store('uploads', 'public');

    // Save the new path (e.g., "uploads/filename.jpg") in DB
    $validatedData['thumbnail'] = $imagePath;
}

    // Update article with validated data
    $article->update($validatedData);

    return redirect()->route('post')->with('success', 'Article updated successfully.');
}


public function search(Request $request){


        $search = $request->input('search');

        $categories =  Category::all();
            $user = Auth::user();

             if ($user->hasAnyRole(['admin','editor'])) {
                    $articles = DB::table('articles')
        ->join('categories', 'articles.category_id', "=", 'categories.id' )
        ->join('users','articles.user_id','=','users.id')
        ->select('categories.name as category_name', 'articles.title', 'articles.updated_at', 'articles.id as article_id','users.name as author')
        ->orderBy('articles.updated_at','desc')->search($search)->get();
        }else{

            $articles = DB::table('articles')
                ->join('categories', 'articles.category_id', '=', 'categories.id')
                ->join('users', 'articles.user_id', '=', 'users.id')
                ->select(
                    'categories.name as category_name',
                    'articles.title',
                    'articles.updated_at',
                    'articles.id as article_id',
                    'users.name as author'
                )
                ->orderBy('articles.updated_at', 'desc')
                ->where('user_id', $user->id)
                ->search($search)->get();


        }


     
   

        return view('dashboard.searchnews',['articles' => $articles, 'search' => $search,'categories'=>$categories,],);



}


}
