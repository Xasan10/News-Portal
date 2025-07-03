<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaCotnroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MediaRequest $request)
    {
          // Optional: filter by article_id if provided via query string
    $query = DB::table('media')
        ->join('articles', 'media.article_id', '=', 'articles.id')
        ->select('media.*', 'articles.title as article_title')
        ->orderBy('media.created_at', 'desc');

    if ($request->has('article_id')) {
        $query->where('media.article_id', $request->article_id);
    }

    $mediaList = $query->get();

    return view('media.index', compact('mediaList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MediaRequest $request)
    {
        
        $data = $request->validated();

        $data['create_at'] = now();

        DB::table('media')->insert($data);

        
    return response()->json(['message' => 'Media added successfully']);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $articleId)
    {
           $article = DB::table('articles')->where('id', $articleId)->first();

    if (!$article) {
        abort(404, 'Article not found');
    }

    $media = DB::table('media')
        ->where('article_id', $articleId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('articles.media', compact('article', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $data = $request->validated();

    // Optionally update the `created_at` or set `updated_at` if needed
    $data['updated_at'] = now(); // only if you want to track updates

    // Update the media record
    $updated = DB::table('media')->where('id', $id)->update($data);

    if (!$updated) {
        return response()->json(['message' => 'Media not found or not updated'], 404);
    }

    return response()->json(['message' => 'Media updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $media = DB::table('media')->where('id', $id)->first();
    if (!$media) {
        return response()->json(['message' => 'Media not found'], 404);
    }

    // If file_type is local (not external), delete the file
    if (in_array($media->file_type, ['image', 'video', 'document'])) {
        Storage::disk('public')->delete($media->media_url);
    }

    // Delete the database record
    DB::table('media')->where('id', $id)->delete();

    return response()->json(['message' => 'Media deleted successfully']);
    }
}
