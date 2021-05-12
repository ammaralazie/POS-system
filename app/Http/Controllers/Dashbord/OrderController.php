<?php

namespace App\Http\Controllers\Dashbord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5); //end of orders

        return view('dashbord.orders.index', compact('orders'));
    } //end of index

    public function products(Order $order)
    {
        $products = $order->product;
        return view('dashbord.orders._products', compact('products', 'order'));
    } //end of products

    public function destroy(Order $order)
    {

        foreach ($order->product as $product) {
            $qunatity = $product->pivot->qunatity;
            $product->stok = $product->stok + $qunatity;
            $product->save();
        } //end of for each

        $order->delete();
        session()->flash('success', __('deleted_successfly'));
        return redirect()->route('dashbord.orders.index');
    } //end of delete
}
