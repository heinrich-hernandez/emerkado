<?php

namespace App\Http\Controllers\Coop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Functions; // Assuming you have a Functions helper for ID generation
use App\Models\Admin_Data\CoopModel; // Assuming you have a CoopModel for database interactions

class AuthCoopController extends Controller
{
    public function getLogin(){
        return view('coop.auth.login'); //url path in folder resources/views/admin/auth/login.blade.php
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_coop'=>1

        ],$request->password); // this is for "remember me" function

        if($validated){
            return redirect()->route('coop-dashboard')->with('success','Login Successfull');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function coopLogout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out.');
    }

    public function getRegister(){
        return view('coop.auth.register'); //url path in folder resources/views/coop/auth/register.blade.php
    }

    public function postRegister(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable',
            'coop_name' => 'required|string|max:255',
            'authorized_representative' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:11',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
            'valid_id_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
            'username' => 'required|string|max:255|unique:coop',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',     // at least one lowercase letter
                'regex:/[A-Z]/',     // at least one uppercase letter
                'regex:/[0-9]/',     // at least one digit
                'regex:/[@$!%*?&]/'  // at least one special character
            ],
            'password_confirmation' => 'nullable|string|min:8',
            'agency_affiliation' => 'required|string|max:255',
            'agency_affiliation_name' => [
                'nullable',
                'required_if:agency_affiliation,yes'
            ],
            'user_role' => 'nullable|string|max:255',
            'business_discription' => 'nullable|string|max:255',
            'approved_by' => 'nullable|string|max:255',
            'date' => 'nullable|date'
        ]);

        // $latestCoop = CoopModel::orderBy('id', 'desc')->first();
        // $nextId = $latestCoop ? $latestCoop->id + 1 : 1;
        // $formattedId = 'VNDR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);



        $data = $validatedData;
        $data['user_id'] = Functions::IDGenerator(new CoopModel, 'user_id', 'COOP', $length, $id );
        $data['user_role'] = $data['user_role'] ?? 'Coop';
        $data['date'] = $data['date'] ?? date('Y-m-d');
        $data['status'] = $data['status'] ?? '0';
        $data['profile_picture'] = $request->hasFile('profile_picture') ? $request->file('profile_picture')->store('profile_pictures', 'public') : null;
        $data['valid_id_picture'] = $request->hasFile('valid_id_picture') ? $request->file('valid_id_picture')->store('valid_id_picture', 'public') : null;
        $data['approved_by'] = $data['approved_by'] ?? '';

        //dd($data);

        try {
            CoopModel::create($data);

            $success = ['status' => 'success', 'user_id' => $data['user_id']];
            return redirect()->route('pages.coop', $success);
        } catch (\Exception $e) {
            $error = ['status' => 'error', 'user_id' => $data['user_id']];
            return redirect()->route('create.coop', $error);
        }
    }

}
