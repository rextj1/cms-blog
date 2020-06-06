<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateProfileRequest;

class UsersController extends Controller
{
    //
    public function index(){
        $users = User::all();
        return view('admin.users.index',compact('users')); 
    }

    public function makeAdmin(User $user){
        dd($user->name);
        $user->role = 'admin';
        $user->save();
        return redirect(route('users.index'))->with('success', 'User made admin successfully');
    }

    public function edit(){
        $user= auth()->user();
        return view('admin.users.edit',compact('user'));
    }

    public function update(UpdateProfileRequest $request){
        $user= auth()->user();
        $user->update([
            'name'=> $request->name,
            'about'=> $request->about
        ]);
        return redirect()->back()->with('success', 'User updated successfully');
    }
    
}
