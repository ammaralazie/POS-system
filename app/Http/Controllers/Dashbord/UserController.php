<?php

namespace App\Http\Controllers\Dashbord;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only(['index']);
        $this->middleware(['permission:create_users'])->only(['create']);
        $this->middleware(['permission:update_users'])->only(['edit']);
        //$this->middleware(['permission:edit_users'])->only(['edit']);
        $this->middleware(['permission:delete_users'])->only(['destroy']);
    } //end of constructer

    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->when($request->search, function ($q) use ($request) {
            return $q->where('first_name', 'like', '%' . $request->search . '%')->orWhere('last_name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(9);
        return view('dashbord.users.index', compact('users'));
    } //end of index

    public function create()
    {
        return view('dashbord.users.create');
    } //end of create


    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'permissions'=>'required|min:1',
            'image'=>'image',
        ]);
        $request_data = $request->except(['password', 'permissions', 'password_confirmation', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            $img = Image::make($request->image);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('media\users_image\ '.$request->image->hashName()));
            $request_data['image']=' '.$request->image->hashName();
        } //end if

        $user = User::create($request_data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        //dd($request->all());
        session()->flash('success', __('site.added_successfly'));
        return redirect()->route('dashbord.users.index');
    } //end of store




    public function edit(User $user)
    {
        return view('dashbord.users.edit', compact('user'));
    } //end of edit


    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user->id),],
            'permissions'=>'required|min:1',
            'image'=>'image',
        ]);
        $request_data = $request->except(['permissions','image']);
        if($user->image){

            if ($user->image !='default.png') {
                Storage::disk('public_file')->delete( '\users_image\.$user->image');
            } //end if
            $img = Image::make($request->image);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('media\users_image\ '.$request->image->hashName()));
            $request_data['image']=' '.$request->image->hashName();

        }//end of if


        $user->update($request_data);

        $user->syncPermissions($request->permissions);
        //dd($request->all());
        session()->flash('success', __('site.updated_successfly'));
        return redirect()->route('dashbord.users.index');
    }

    public function destroy(User $user)
    {
        if($user->image !='default.png'){
            Storage::disk('public_file')->delete( '\users_image\.$user->image');
        }//end of if
        session()->flash('success', __('site.deleted_successfly'));
        $user->delete();
        return redirect()->back();
    }
}
