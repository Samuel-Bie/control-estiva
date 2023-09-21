<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('clients.index', [
            'clients' => Client::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->gender = $request->gender;
        $client->id_number = $request->id_number;
        $client->birthdate = $request->birthdate;
        $client->phone = $request->phone;
        $client->company = $request->company;
        $client->role = $request->role;
        $client->address = $request->address;
        $client->save();

        // Redirect to show the saved client
        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {

        $client->name = $request->name;
        $client->gender = $request->gender;
        $client->id_number = $request->id_number;
        $client->birthdate = $request->birthdate;
        $client->phone = $request->phone;
        $client->company = $request->company;
        $client->role = $request->role;
        $client->address = $request->address;
        $client->save();
        //

        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {

        if ($client->transactions()->exists()) {
            return redirect()->route('clients.show', $client->id)->with(
                'error',
                'Client has transactions, cannot delete'
            );
        } else {
            $client->delete();
        }

        return redirect()->route('clients.index');
    }
}
