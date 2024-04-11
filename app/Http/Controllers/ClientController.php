<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function allClient()
    {
        $clients = Client::all();

        return response()->json([
            'status' => 'ok',
            'clients' => $clients,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'nullable|string',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return response()->json([
            'status' => 'ok',
            'message' => "usuario creado",
        ]);
    }

    public function getClientById($id)
    {
        $client = Client::find($id);

        return response()->json([
            'status' => 'ok',
            'Client' => $client,
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        $client->name = $request->name;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return response()->json([
        'status' => 'ok',
        'message' => "Cliente actualizado",
    ]);
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return response()->json([
            'status' => 'ok',
            'message' => "Cliente eliminado",
        ]);
    }
}
