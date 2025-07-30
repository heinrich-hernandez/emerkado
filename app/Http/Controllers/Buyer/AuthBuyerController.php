<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Functions; // Assuming you have a Functions helper for ID generation
use App\Models\Admin_Data\BuyerModel; // Assuming you have a BuyerModel for database interactions

class AuthBuyerController extends Controller
{
    public function getLogin(){
        return view('buyer.auth.login'); //url path in folder resources/views/admin/auth/login.blade.php
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_buyer'=>1

        ],$request->password); // this is for "remember me" function

        if($validated){
            return redirect()->route('buyer-dashboard')->with('success','Login Successfull');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function buyerLogout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out.');
    }

    public function getRegisterBuyer(){
        return view('buyer.auth.register'); //url path in folder resources/views/buyer/auth/register.blade.php
    }

    public function postRegisterBuyer(Request $request)
    {
        \Log::info('postRegisterBuyer initiated.');

        $data = $request->validate([
            'user_id' => 'nullable',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:11',
            'email' => 'required|email|max:255|unique:buyer',
            'buyer_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
            'buyer_valid_id_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
            'username' => 'required|string|max:255|unique:buyer',
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
            'user_role' => 'nullable|string|max:255',
            'review_status' => 'nullable|string|max:255',
            'approved_by' => 'nullable|string|max:255',
            'date' => 'nullable|date'
        ]);

        $data['user_id'] = $data['user_id'] ?? 'temp-id';
        $data['user_role'] = $data['user_role'] ?? 'Buyer';
        $data['date'] = $data['date'] ?? date('Y-m-d');
        $data['status'] = $data['status'] ?? '0';
        $data['review_status'] = $data['review_status'] ?? 'For Review';

        $filename = $data['username'];
        $filename_sanitized = preg_replace('/[^A-Za-z0-9]/', '', $filename);
        if ($request->hasFile('buyer_profile_picture')) {
            $data['profile_picture'] = ImageResizer::resizeAndSaveImage($request->file('buyer_profile_picture'), 'buyer_profile_picture', $filename_sanitized);
        }

        // Handle and resize valid ID picture
        if ($request->hasFile('buyer_valid_id_picture')) {
            $data['valid_id_picture'] = ImageResizer::resizeAndSaveImage($request->file('buyer_valid_id_picture'), 'buyer_valid_id_picture', $filename_sanitized);
        }
       

        //encryp password before storing to database
        $data['password'] = bcrypt($data['password']);

        // dd($data);
        BuyerModel::create($data);

        // CREATE ID WITH PREFIX (this is after buyer create executed above.)
        $id = BuyerModel::max('id');
        $newRecord = BuyerModel::find($id);
        if ($newRecord === null) {
            // Handle the case when the table is empty
            return response()->json(['message' => 'No records found.'], 404);
        } 
        // dd($newRecord);
        $user_id = Functions::IDGenerator(new BuyerModel, 'user_id', 'COOP', 5, $id);
        // dd($user_id);
        // Define the user ID you want to set (e.g., from the request or another source)
        //$userId = $request->input($data_update); // Replace with your logic

        // Update the user_id column
        $newRecord->user_id = $user_id;
        // dd($newRecord);
        $newRecord->save();

        $success = ['status' => 'success'];
        return redirect()->route('getLogin', $success);
    }

}
