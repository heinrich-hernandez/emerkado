<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{AdminModel, CoopModel, MerchantModel, BuyerModel};

class ProfileController extends Controller
{
    public function dashboard(){

        $admin = AdminModel::select('user_id', 'name', 'user_role', 'status')->get();
        $coop = CoopModel::select('user_id', 'authorized_representative as name', 'user_role', 'status')->get();
        $merchant = MerchantModel::select('user_id', 'name', 'user_role', 'status')->get();
        $buyer = BuyerModel::select('user_id', 'name', 'user_role', 'status')->get();

        // Merge both collections
        $users = $admin->concat($coop)->concat($merchant)->concat($buyer);

        // Sort by id if needed
        $users = $users->sortBy('id');

        // return view('admin.pages.dashboard',$data); //url path in folder resources/views/admin/dashboard.blade.php
        return view('admin.pages.dashboard', compact('users'));
    }
}
