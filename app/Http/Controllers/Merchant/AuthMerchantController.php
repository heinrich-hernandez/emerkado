<?php

namespace App\Http\Controllers\Coop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthCoopController extends Controller
{
    public function getLogin(){
        return view('coop.auth.login'); //url path in folder resources/views/admin/auth/login.blade.php
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_coop'=>1

        ],$request->password); // this is for "remember me" function

        if($validated){
            return redirect()->route('coop-dashboard')->with('success','Login Successfull');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function coopLogout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out.');
    }
}
