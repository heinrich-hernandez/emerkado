<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\BuyerModel; 
use Illuminate\Support\Facades\Auth;

class ProfileBuyerController extends Controller
{
    public function dashboard(){
        if(Auth::user()->review_status != "Approved"){
            // If the user is not approved, redirect to the profile page with an error message
            return redirect('/buyer/profile/')->with('error', 'Please verify your account first.');
        } else {
            $data=[
                'title'=>'Dashboard',
            ];
            return view('buyer.pages.dashboard',$data); //url path in folder resources/views/admin/dashboard.blade.php
        }
    }

    public function profile(){
        // Fetch the buyer data from the BuyerModel
        $buyer = BuyerModel::where('user_id', Auth::id())->first(); // Fetch the buyer data for the authenticated user
        $data = [
            'title' => 'Profile',
            'buyer' => Auth::user(), // Pass the buyer data to the view
            'profile_picture' => Auth::user()->profile_picture, // Pass the profile picture to the view
            'valid_id_picture' => Auth::user()->valid_id_picture, // Pass the valid ID picture to the view
            'address' => Auth::user()->address, // Pass the address to the view
            'contact_number' => Auth::user()->contact_number, // Pass the contact number to the view
            'email' => Auth::user()->email, // Pass the email to the view
            'username' => Auth::user()->username, // Pass the username to the view
        ];
        return view('buyer.pages.profile', $data); //url path in folder resources/views/coop/profile.blade.php
    }
}
