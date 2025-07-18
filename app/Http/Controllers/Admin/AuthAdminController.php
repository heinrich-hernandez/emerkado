<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login'); //url path in folder resources/views/admin/auth/login.blade.php
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_admin'=>1

        ],$request->password); // this is for "remember me" function

        if($validated){
            return redirect()->route('admin-dashboard')->with('success','Login Successfull');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function adminLogout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out.');
    }
}
