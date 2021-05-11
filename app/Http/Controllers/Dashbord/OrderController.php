<?php

namespace App\Http\Controllers\Dashbord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders=Order::whereHas('client',function($q) use($request){

            return $q->where('name','like','%'.$request->search.'%');

        })->latest()->paginate(5);//end of orders

        return view('dashbord.orders.index',compact('orders'));

    }//end of index
}
