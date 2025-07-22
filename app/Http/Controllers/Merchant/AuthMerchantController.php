<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthMerchantController extends Controller
{
    public function getLogin(){
        return view('merchant.auth.login'); //url path in folder resources/views/admin/auth/login.blade.php
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_merchant'=>1

        ],$request->password); // this is for "remember me" function

        if($validated){
            return redirect()->route('merchant-dashboard')->with('success','Login Successfull');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function merchantLogout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out.');
    }

    public function getRegister(){
        return view('merchant.auth.register'); //url path in folder resources/views/merchant/auth/register.blade.php
    }
}
