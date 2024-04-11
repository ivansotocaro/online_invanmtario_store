<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Product;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyController extends Controller
{

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Crear la compra
            $buy = Buy::create([
                'client_id' => $request->clienteID,
                'total' => $request->total,
                'discount' => $request->descuento,
            ]);

            // Adjuntar los productos a la compra
            $detalleCompra = [];
            foreach ($request->detalle as $detalle) {
                $product = Product::where('id', $detalle['productoId'])
                    ->where('is_active', 1)
                    ->first();

                if ($product->stock >= $detalle['cantidad']) {
                    $product->stock -= $detalle['cantidad'];

                    $totalfinal = ($product->price * $detalle['cantidad']) == $detalle['total']
                                    ? $detalle['total'] : $product->price * $detalle['cantidad'];


                    $product->save();

                    $detalleCompra[$detalle['productoId']] = [
                        'quantity' => $detalle['cantidad'],
                        'total' => $totalfinal,
                    ];
                } else {
                    DB::rollBack(); // Revertir cualquier cambio en la base de datos
                    return response()->json([
                        'status' => 'ok',
                        'message' => "No hay suficiente producto de ". $product->name ." en el inventario",
                    ]);
                }
            }

            $buy->products()->sync($detalleCompra);

            DB::commit(); // Confirmar los cambios en la base de datos

            return response()->json([
                'status' => 'ok',
                'message' => "Compra realizada",
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cualquier cambio en la base de datos en caso de excepción
            return "Ha ocurrido un error al procesar la compra: " . $e->getMessage();
        }
    }


//    TODO: esto es lo que debo recibir de mi front
//Dewscuento: = 30×0.12=3.6  - 30−3.6=26.4
//{
    //"total": 26.4,
    //"descuento": 12,
    //"clienteID": 1,
    //"detalle": [
            //{
            //"productoId": 1,
            //"cantidad": 2,
            //"total": 15
            //}
    //]
//}

}
