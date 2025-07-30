<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    protected $redirectTo = '/user-login';
    
    public function getLogin(){
        \Log::info('getLogin(): Initiated');
        return view('auth.login'); //url path in folder resources/views/admin/auth/login.blade.php
    }

    public function postLogin(Request $request){
        $guard = $request->input('user_type'); // 'coop', 'merchant', or 'buyer'
        $credentials = $request->only('email', 'password');
    
        \Log::info('User type received:', ['user_type' => $guard]);
        \Log::info('Credentials:', ['email' => $credentials['email']]);
    
        try {
            $userModel = $this->getUserModel($guard);
            \Log::info('Resolved User Model:', ['user_model' => $userModel]);
            
            $user = $userModel::where('email', $credentials['email'])->first();
            \Log::info('User fetched:', ['user' => $user]);
    
            if ($user && $user->status == '1') {
                if (Auth::guard($guard)->attempt($credentials)) {
                    \Log::info('Authentication successful.');
                    return redirect()->route($guard.'-dashboard'); //redirect()->intended($guard.'/dashboard');
                } else {
                    \Log::warning('Authentication failed.');
                    // return back()->withErrors(['Invalid credentials.']);
                    return redirect()->route('getLogin')->with('error', 'Invalid credentials.');
                }
            } else {
                \Log::warning('User not approved or does not exist.');
                // return back()->withErrors(['Your account is not approved or does not exist.']);
                return redirect()->back()->with('error','Your account is not approved or does not exist.');
            }
        } catch (\Exception $e) {
            \Log::error('Exception caught:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error','Invalid User Type');
        }
    }

    public function Logout($guard = null){
        Auth::guard($guard)->logout();
        session()->flush(); // Clear all session data
        \Log::warning('Logout.');
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out.');
    }

    protected function getUserModel($guard)
        {
            switch ($guard) {
                case 'admin':
                    return \App\Models\Admin::class;
                case 'coop':
                    return \App\Models\Coop::class;
                case 'merchant':
                    return \App\Models\Merchant::class; 
                case 'buyer':
                    return \App\Models\Buyer::class;
                default:
                    throw new \Exception('Invalid user type.');
            }
        }
}

