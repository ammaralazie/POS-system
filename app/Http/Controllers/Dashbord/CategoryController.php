<?php

namespace App\Http\Controllers\Dashbord;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::when($request->search,function($q) use($request){
            return $q->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(5);
        return view('dashbord.categories.index', compact('categories'));
    } //end of index


    public function create()
    {
        return view('dashbord.categories.create');
    } //end of create


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        $category = Category::create($request->all());
        session()->flash('success', __('site.added_successfly'));
        return redirect()->route('dashbord.categories.index');
    } //end of store

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('dashbord.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required',Rule::unique('categories')->ignore($category->id)],
        ]);
        $category->update($request->all());
        session()->flash('success', __('site.updated_successfly'));
        return redirect()->route('dashbord.categories.index');
    }//end of update

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfly'));
        return redirect()->back();
    }//end of delete
}
