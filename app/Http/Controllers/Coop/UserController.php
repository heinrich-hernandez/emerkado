<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.pages.coop', $data); //url path in folder resources/views/admin/pages/coop.blade.php
    }

    public function create_coop()
    {
        $data = [
            'title' => 'Registration'
        ];
        return view('admin.pages.create_coop', $data);
    }
}
