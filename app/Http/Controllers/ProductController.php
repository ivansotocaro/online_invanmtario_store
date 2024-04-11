<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductsAvailable(){
        $productosAvailable = Product::where('stock', '>', 0)->
            where('is_active', 1)->get();
        return $productosAvailable;
//        return response()->json(['ok' => 'true', 'data' => $productosAvailable]);
    }

    public function getProductById($id){
        $producto = Product::where('id', $id)
            ->where('is_active', 1)
            ->first();
        return $producto;
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

        $product = Product::where('id', $id)
            ->where('is_active', 1)
            ->first();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $product;
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)
            ->where('is_active', 1)
            ->first(); // Buscar el producto por su ID
        $product->is_active = 0; // Establecer el estado is_active a 0 (inactivo)
        $product->save(); // Guardar el producto actualizado en la base de datos

        return $product;
    }

}
