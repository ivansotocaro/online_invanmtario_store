<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductsAvailable(){
        $productosAvailable = Product::where('stock', '>', 0)->get();
        return $productosAvailable;
//        return response()->json(['ok' => 'true', 'data' => $productosAvailable]);
    }

    public function getProductById($id){
        $producto = Product::find($id);
        return  $producto;
//        return response()->json(['ok' => 'true', 'data' => $productosAvailable]);
    }

}
