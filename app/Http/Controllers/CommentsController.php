<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
 
    public function index()
    {
        
    }


    public function store(CommentsRequest $request)
    {
        
        $data = $request->validated();

        DB::table('comments')->insert([
        'body' => $data['body'],
        'article_id' => $data['article_id'],
        'user_id' => $data['user_id'] ?? null,
        'created_at' => now(),
        'updated_at' => now(),
        ]);

        return response()->json(['message'=> 'comment succesfully added']);

    }

  
    public function show( $id)
    {
        
        $comment = DB::table('comments')->where('id',$id)->first();
    

        if (!$comment) {

            return response()->json(['message'=> 'comment not found'],404); 
        
        
        }

        return new CommentsResource($comment);


    }


    public function update(Request $request, string $id)
    {
           $data = $request->validated();

    // Optional: check if comment exists
    $comment = DB::table('comments')->where('id', $id)->first();
    if (!$comment) {
        return response()->json(['message' => 'Comment not found'], 404);
    }

    // Update the comment
    DB::table('comments')->where('id', $id)->update([
        'body' => $data['body'],
        'updated_at' => now(),
    ]);

    return response()->json(['message' => 'Comment updated successfully']);



    }


    public function destroy(string $id)
    {
          $comment = DB::table('comments')->where('id', $id)->first();

    if (!$comment) {
        return response()->json(['message' => 'Comment not found'], 404);
    }

    DB::table('comments')->where('id', $id)->delete();

    return response()->json(['message' => 'Comment deleted successfully']);
    }
}
