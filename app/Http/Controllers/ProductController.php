<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
//use Faker\Core\File;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    function productPage(){
        return view('pages.dashboard.productPage');
    }

    //create products
    function createProduct(Request $request){
        try{
            $user_id = $request->header('id');

            $img = $request->file('img');

            $t=time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "images/products/{$img_name}";

            //upload file
            $img->move(public_path('images/products'),$img_name);

            $quantity = $request->input('quantity');

            Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'quantity' => $quantity,
                'category_id' => $request->input('category_id'),
                'img_url' => $img_url,
                'user_id' => $user_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Product add successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                //'message' => 'Request failed'
                'message' => $e->getMessage()
            ], 200);
        }
        
    }
    public function checkLowStock(){
        $lowStock = Product::where('quantity', '<=', 5)->get(['id', 'name', 'quantity']);
        return response()->json([
            'count' => $lowStock->count(),
            'products' => $lowStock
        ]);
    }
    //delete products
    function deleteProduct(Request $request){
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        $filePath = $request->input('file_path');
        File::delete($filePath);
        Product::where('id', $product_id)->where('user_id', $user_id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Product delete successfully'
        ], 200);

    }
    //product by id
    function productById(Request $request){
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        $productById = Product::where('id', $product_id)->where('user_id', $user_id)->first();
        return response()->json($productById);
    }
    //product list
    function productList(Request $request){
        $user_id = $request->header('id');
        $productList = Product::where('user_id', $user_id)->get();
        return response()->json($productList);
    }
    //product update
    function productUpdate(Request $request){
        $user_id = $request->header('id');
        $product_id = $request->input('id');

        if($request->hasFile('img')){
            $img = $request->file('img');

            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "images/products/{$img_name}";

            //upload file
            $img->move(public_path('images/products'),$img_name);

            $filePath = $request->input('file_path');
            File::delete($filePath);

            Product::where('id', $product_id)->where('user_id', $user_id)->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category_id'),
                'img_url' => $img_url
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Product update successfully'
            ], 200);
            
        }else{
            Product::where('id', $product_id)->where('user_id', $user_id)->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category_id')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Product update successfully'
            ], 200);
        }
    }
}
