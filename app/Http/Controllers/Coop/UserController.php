<?php

namespace App\Http\Controllers\Coop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coop\{CoopModel};
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
        return view('coop.pages.coop', $data); //url path in folder resources/views/coop/pages/coop.blade.php
    }

    public function create_coop()
    {
        $data = [
            'title' => 'Registration'
        ];
        return view('coop.pages.coop_profile', $data);
    }
}
