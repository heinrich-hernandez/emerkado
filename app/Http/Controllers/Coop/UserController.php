<?php

namespace App\Http\Controllers\Coop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{CoopModel};
use App\Helpers\Functions;

class UserController extends Controller
{

    public function coop()
    {
        $coop = CoopModel::all();
        $data = [
            'title' => 'Coop',
            'coop' => $coop
        ];
        return view('coop.pages.profile', $data); //url path in folder resources/views/admin/pages/coop.blade.php
    }

    public function guest_create_coop() 
    {
        $data = [
            'title' => 'Registration'
        ];
        return view('coop.pages.profile', $data);
    }
}
