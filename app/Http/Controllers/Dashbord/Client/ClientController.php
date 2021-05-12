<?php

namespace App\Http\Controllers\Dashbord\Client;

use App\Category;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class ClientController extends Controller
{
    public function index(){

    }//end of index

    public function create(Client $client){
        $categories =Category::with('product')->get();
        return view('dashbord.clients.orders.create',compact('categories','client'));
    }//end of create

    public function store(Client $client,Request $request){

        $request->validate([
            'products'=>'required|array'
        ]);

        $order=$client->orders()->create([]);
        $total_price=0;
        $quna=0;
        foreach($request->products as $index=>$product){
            foreach($product as $quantity){
                $order->product()->attach($index,[
                'qunatity'=>$quantity,
            ]);
            $quna+=$quantity;
            }//end insted loop

            $product=Product::FindOrFail($index);
            $total_price +=$product->sale_price*$quna;
            $product->stok=$product->stok-$quna;
            $product->save();

        }//end of froeach
        $order->update([
            'total_price'=>$total_price
        ]);
        $order->save();

       session()->flash('success',__('added_successfly'));
       return redirect()->route('dashbord.orders.index');

    }//end of store

    public function edit(Client $client,Order $order){

    }//end of edit

    public function update(Client $client,Request $request,Order $order){

    }//end of update

    public function destry(Client $client,Order $order){

    }//end of delete

}
