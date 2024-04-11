<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function allClient()
    {
        $clients = Client::all();
        return $clients;
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

        return $client;
    }

    public function getClientById($id)
    {
        $client = Client::find($id);
        return $client;
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        $client->name = $request->name;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return true;
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return true;
    }
}
