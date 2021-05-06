<?php

namespace App\Http\Controllers\Dashbord;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Image;

class ProductCotroller extends Controller
{

    public function index(Request $request)
    {
        $products = Product::latest()->paginate(5);
        return view('dashbord.product.index', compact('products'));
    } //end of index

    public function create()
    {

        $categories = Category::all();
        return view('dashbord.product.create', compact('categories'));
    } //end of create

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
           'name_ar'=>'required|unique:products,name_ar' ,
           'discription_ar'=>'required',
           'name_en'=>'required|unique:products,name_en' ,
           'discription_en'=>'required',
           'parchase_price'=>'required|numeric',
           'sale_price'=>'required|numeric',
           'stok'=>'required|numeric',
           'category_id'=>'required',
           'image'=>'image',

        ]);
        $request_data=$request->except(['image']);
        if($request->image){
            $img=Image::make($request->image);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('media/products_image/'.$request->image->hashName()));
        }//end if image
        $request_data['image']=$request->image->hashName();
        //dd( $request_data);
        $proudct=Product::create($request_data);
        session()->flash('success', __('site.added_successfly'));
        return redirect()->route('dashbord.products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
