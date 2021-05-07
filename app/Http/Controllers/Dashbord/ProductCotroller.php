<?php

namespace App\Http\Controllers\Dashbord;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;
use Image;

class ProductCotroller extends Controller
{

    public function index(Request $request)
    {
        $categoties=Category::all();
        $products = Product::when($request->search,function ($q) use($request){
            $q->where('name_ar','like','%'.$request->search.'%')
            ->orwhere('name_en','like','%'.$request->search.'%');
        })->when($request->category_id,function($q) use($request){
            $q->where('category_id','like','%'.$request->category_id.'%');
        })->latest()->paginate(3);
        return view('dashbord.product.index', compact('products','categoties'));
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
            $request_data['image']=$request->image->hashName();
        }//end if image

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
    {   $categories=Category::all();
        return view('dashbord.product.edit',compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_ar'=>['required',ValidationRule::unique('products')->ignore($product->id)],
            'discription_ar'=>'required',
            'name_en'=>['required',ValidationRule::unique('products')->ignore($product->id)],
            'discription_en'=>'required',
            'parchase_price'=>'required|numeric',
            'sale_price'=>'required|numeric',
            'stok'=>'required|numeric',
            'category_id'=>'required',
            'image'=>'image|max:10000',

         ]);
         $request_datq=$request->except(['image']);
        if($request->image){
            if($product->image !='default.png'){
                Storage::disk('public_file')->delete('/products_image/'.$product->image);
            }//end of default image
            $img=Image::make($request->image);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('media\users_image\ '.$request->image->hashName()));
          // dd($request->all());
           $request_datq['image']=$request->image->hashName();
        }//end of if image
       $product->update($request_datq);
       session()->flash('success', __('site.updated_successfly'));
       return redirect()->route('dashbord.products.index');
    }

    public function destroy(Product $product)
    {
        if($product->image !='default.png'){
            Storage::disk('public_file')->delete('/products_image/'.$product->image);
        }//end of if
        $product->delete();
        return redirect()->back();
    }
}
