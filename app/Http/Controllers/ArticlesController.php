<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Articel;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    
public function index(){

   $articles = Article::all();
   

    return ArticleResource::collection($articles);





}    


public function store(ArticleRequest $request)
{

        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article = Article::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => $data['user_id'],
            'category_id' => $data['category_id'],
            'thumbnail' => $data['thumbnail'] ?? null,
            'views' => 0
        ]);

        return new ArticleResource($article->fresh());


}



public function update(ArticleRequest $request, $id)
{
    $data = $request->validated();

    if ($request->hasFile('thumbnail')) {
        $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    $article = Article::findOrFail($id);
    $article->update($data);

    return new ArticleResource($article);
}




public function destroy($id){

    $article = DB::table('articles')->where('id',$id)->first();

    if (!$article) {
        
        return response()->json(['messsage'=>'not found'],404);
    }

    if ($article->thumbnail) {
        
        Storage::disk('public')->delete($article->thumbnail);

    }


    DB::table('articles')->where('id', $id)->delete();
    
       return response()->json(['message' => 'Article deleted successfully']);



}

public function show($id){

$article = Article::findOrFail($id);


return new ArticleResource($article);




}




}
