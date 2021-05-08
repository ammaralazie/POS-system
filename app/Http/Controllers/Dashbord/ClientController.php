<?php

namespace App\Http\Controllers\Dashbord;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::paginate(5);
        return view('dashbord.clients.index')->with('clients', $clients);
    } //end of index


    public function create()
    {
        return view('dashbord.clients.create');
    } //end fo create


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);
        $client=Client::create($request->all());
        session()->flash('success',__('site.added_successfly'));
        return redirect()->route('dashbord.clients.index');
    } //end of store


    public function show(Client $client)
    {

    }

    public function edit(Client $client)
    {
        //
    }


    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
    }
}
