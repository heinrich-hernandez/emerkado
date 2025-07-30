<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthBuyerController extends Controller
{
    public function getLogin(){
        return view('buyer.auth.login'); //url path in folder resources/views/admin/auth/login.blade.php
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_buyer'=>1

        ],$request->password); // this is for "remember me" function

        if($validated){
            return redirect()->route('buyer-dashboard')->with('success','Login Successfull');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function buyerLogout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out.');
    }

}
