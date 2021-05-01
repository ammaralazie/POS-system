<?php

namespace App\Http\Controllers\Dashbord;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        $users=User::all();
        return view('dashbord.users.index',compact('users'));
    }//end of index

    public function create()
    {
        return view('dashbord.users.create');
    }//end of create


    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
        ])  ;
        $request_data=$request->except(['password','permissions','password_confirmation']);
        $request_data['password']=bcrypt($request->password);

        $user=User::create($request_data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        //dd($request->all());
        session()->flash('success',__('site.added_successfly'));
        return redirect()->route('dashbord.users.index');


    }//end of store




    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
