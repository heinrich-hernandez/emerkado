<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Admin_Data\BuyerModel;
use Illuminate\Http\Request;
use App\Helpers\Functions;

class BuyerController extends Controller
{

    public function add_buyer(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable',
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:11',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
            'valid_id_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
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

        // $latestBuyer = BuyerModel::orderBy('id', 'desc')->first();
        // $nextId = $latestBuyer ? $latestBuyer->id + 1 : 1;
        // $formattedId = 'VNDR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);



        $data = $validatedData;
        $data['user_id'] = Functions::IDGenerator(new BuyerModel, 'user_id', 'Buyer', $length, $id );
        $data['user_role'] = $data['user_role'] ?? 'Buyer';
        $data['date'] = $data['date'] ?? date('Y-m-d');
        $data['status'] = $data['status'] ?? '0';
        $data['profile_picture'] = $request->hasFile('profile_picture') ? $request->file('profile_picture')->store('profile_pictures', 'public') : null;
        $data['valid_id_picture'] = $request->hasFile('valid_id_picture') ? $request->file('valid_id_picture')->store('valid_id_picture', 'public') : null;
        $data['approved_by'] = $data['approved_by'] ?? '';

        //dd($data);

        try {
            BuyerModel::create($data);

            $success = ['status' => 'success', 'user_id' => $data['user_id']];
            return redirect()->route('pages.buyer', $success);
        } catch (\Exception $e) {
            $error = ['status' => 'error', 'user_id' => $data['user_id']];
            return redirect()->route('create.buyer', $error);
        }
    }
}
