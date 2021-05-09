<?php

namespace App\Http\Controllers\Dashbord\Client;

use App\Category;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class ClientController extends Controller
{
    public function index(){

    }//end of index

    public function create(Client $client){
        $categories =Category::with('product')->get();
        return view('dashbord.clients.orders.create',compact('categories','client'));
    }//end of create

    public function store(Client $client,Request $request){

    }//end of store

    public function edit(Client $client,Order $order){

    }//end of edit

    public function update(Client $client,Request $request,Order $order){

    }//end of update

    public function destry(Client $client,Order $order){

    }//end of delete

}
