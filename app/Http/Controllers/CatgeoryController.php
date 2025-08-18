<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class CatgeoryController extends Controller
{
    public function index(){

        $categories  = DB::table('categories')->get();

        return CategoryResource::collection($categories);



    }

    public function store(CategoryRequest $request){

        $validated = $request->validated();


         $category = Category::create([
            'name' => $validated['name'],
            'slug' => \Illuminate\Support\Str::slug($validated['name']),
        ]);

        return response()->json(
            [
                'message'=> 'category created succesfully',
                'data'=> new CategoryResource($category->fresh())
            ],201
        );


    }

    public function show($id){


       try {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Category not found',
        ], 404);
    }



    }

    public function update(CategoryRequest $request,$id){

   


        try {
            
                $category = Category::findOrFail($id);
            $category->update($request->validated());

            
             return response()->json(
            [
                'message'=> 'category updated succesfully',
                'data'=> $category->fresh()
                 ],200
            );




        } catch (ModelNotFoundException $th) {
          
              return response()->json([
            'message' => 'Category not found',
        ], 404);


        }



    }

    public function destroy($id){
           try {
        // Find the category or fail with 404
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Return success message
        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);

    } catch (ModelNotFoundException $e) {
        // Category not found
        return response()->json([
            'message' => 'Category not found'
        ], 404);
    } catch (\Exception $e) {
        // Other errors
        return response()->json([
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500);
    }
    }


    public function showCategory(){


        $categories = DB::table('categories')->get();

        $user = Auth::user();

        return view('dashboard.dashboardcategory',['categories' => $categories,'user'=>$user]);



    }

    public function showEdit($id){


        $category = Category::findOrFail($id);


        return view('dashboard.editCategory', ['category' => $category]);

    }




}
