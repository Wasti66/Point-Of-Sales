<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function categoryPage(){
        return view('pages.dashboard.categoryPage');
    }
    
    // categories list
    function categoriesList(Request $request){
        $user_id = $request->header('id');
        return Category::where('user_id', '=', $user_id)->get();
    }

    // create categories
    function createCaregories(Request $request){
        try{

            $user_id = $request->header('id');
            $name = $request->input('name');
            Category::create([
                'name' => $name,
                'user_id' => $user_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'category add successfully'
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'
            ], 200);
        }
        
    }

    // category delete
    function categoryDelete(Request $request){
        try{
            $category_id = $request->input('id');
            $user_id = $request->header('id');
            Category::where('id', $category_id)
                    ->where('user_id', $user_id)
                    ->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Category delete successfully' 
            ], 200); 
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong' 
            ], 200); 
        }
                
    }

    //category by id
    function categoryById(Request $request){
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        $category = Category::where('id', $category_id)->where('user_id', $user_id)->first();
        return response()->json($category);
    }

    //category update
    function categoryUpdate(Request $request){
        $name = $request->input('name');
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        Category::where('id', $category_id)->where('user_id', $user_id)->update([
            'name' => $name
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Category update successfully' 
        ], 200);
    }

}
