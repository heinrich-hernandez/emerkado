<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{MerchantModel};
use App\Helpers\Functions;

class UserController extends Controller
{

    public function merchant()
    {
        $merchant = MerchantModel::all();
        $data = [
            'title' => 'Merchant',
            'merchant' => $merchant
        ];
        return view('admin.pages.merchant', $data); //url path in folder resources/views/admin/pages/merchant.blade.php
    }

    public function create_merchant(Request $request)
    {
        $data = [
            'title' => 'Create Merchant'
        ];
        return view('admin.pages.create_merchant', $data); //url path in folder resources/views/admin/pages/create_merchant.blade.php
    }

}
