<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{CoopModel, MerchantModel, BuyerModel};
use Illuminate\Support\Facades\Auth;
// use App\Models\Admin_Data\{AdminModel, CoopModel, MerchantModel}; //Insert Merchant Models here..

class ProfileMerchantController extends Controller
{


    public function dashboard(){
        $coop = CoopModel::select('user_id', 'authorized_representative as name', 'user_role', 'status', 'review_status')->get();
        $buyer = BuyerModel::select('user_id', 'name', 'user_role', 'status', 'review_status')->get();
    
        // Merge both collections
        $users = ($coop)->concat($buyer);
    
        // Sort by id if needed
        $users = $users->sortBy('id');
        $data=[
            'title'=>'Dashboard',
        ];
        return view('merchant.pages.dashboard',$data, compact('users')); //url path in folder resources/views/admin/dashboard.blade.php
    }

    public function profile(){
        // Fetch the coop data from the CoopModel
        $merchant = CoopModel::where('user_id', Auth::id())->first(); // Fetch the merchant data for the authenticated user
        $data = [
            'title' => 'Profile',
            'merchant' => Auth::user(), // Pass the merchant data to the view
            'profile_picture' => Auth::user()->profile_picture, // Pass the profile picture to the view
            'valid_id_picture' => Auth::user()->valid_id_picture, // Pass the valid ID picture to the view
            'address' => Auth::user()->address, // Pass the address to the view
            'contact_number' => Auth::user()->contact_number, // Pass the contact number to the view
            'email' => Auth::user()->email, // Pass the email to the view
            'username' => Auth::user()->username, // Pass the username to the view
        ];
        return view('merchant.pages.profile', $data); //url path in folder resources/views/coop/profile.blade.php
    }
}
