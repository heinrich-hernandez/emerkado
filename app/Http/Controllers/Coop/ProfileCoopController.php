<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Admin_Data\{AdminModel, CoopModel, MerchantModel}; //Insert Merchant Models here..

class ProfileController extends Controller
{
    public function dashboard(){
        $data=[
            'title'=>'Dashboard',
        ];
        return view('coop.pages.dashboard',$data); //url path in folder resources/views/admin/dashboard.blade.php
    }
}
