<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{BuyerModel};
use App\Helpers\Functions;

class UserController extends Controller
{

    public function buyer()
    {
        $buyer = BuyerModel::all();
        $data = [
            'title' => 'Buyer',
            'buyer' => $buyer
        ];
        return view('admin.pages.buyer', $data); //url path in folder resources/views/admin/pages/buyer.blade.php
    }

    public function create_buyer()
    {
        $data = [
            'title' => 'Registration'
        ];
        return view('admin.pages.create_buyer', $data);
    }
}
