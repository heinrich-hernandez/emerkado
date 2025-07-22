<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Admin_Data\{AdminModel, CoopModel, MerchantModel}; //Insert Merchant Models here..

class ProfileBuyerController extends Controller
{
    public function dashboard(){
        $data=[
            'title'=>'Dashboard',
        ];
        return view('buyer.pages.dashboard',$data); //url path in folder resources/views/admin/dashboard.blade.php
    }
}
