<?php

namespace App\Http\Controllers\Dashbord;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
class WelcomeController extends Controller
{
    public function index()
    {
        $products_count = Product::count();
        $clients_count  = Client::count();
        $categories_count   = Category::count();
        $orders_count = Order::count();
        $users_count = User::whereRoleIs('admin')->count();

        return view('dashbord.index', compact(

            'products_count',
            'clients_count',
            'categories_count',
            'orders_count',
            'users_count'
        ));
    } //end of index
}
