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

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01', // Valida que el precio sea numérico y positivo
            'stock' => 'required|integer|min:0', // Valida que el stock sea un entero y positivo
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $product;
    }

    public function update(Request $request, $id){

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $product;
    }

}
