<?php

namespace App\Http\Controllers\Dashbord;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::when($request->search,function ($q) use($request){
            $q->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(5);
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



    public function edit(Client $client)
    {
        return view('dashbord.clients.edit',compact('client'));
    }//end of edit


    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);
        $client->update($request->all());
        session()->flash('success',__('site.updated_successfly'));
        return redirect()->route('dashbord.clients.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success',__('site.deleted_successfly'));
        return redirect()->route('dashbord.clients.index');
    }
}
