<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $products_count = Product::count();
        $clients_count  = Client::count();
        $categories_count   = Category::count();
        $orders_count = Order::count();
        $users_count = User::whereRoleIs('admin')->count();

        $sales_data=Order::select(
            DB::select('select * from orders')
        );

        dd($sales_data);

        return view('dashbord.index', compact(

            'products_count',
            'clients_count',
            'categories_count',
            'orders_count',
            'users_count'
        ));
    } //end of index
}
