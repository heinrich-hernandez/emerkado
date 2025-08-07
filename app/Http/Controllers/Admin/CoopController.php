<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin_Data\CoopModel;
use Illuminate\Http\Request;
use App\Helpers\{Functions, ImageResizer};

class CoopController extends Controller
{

    public function add_coop(Request $request)
    {
        // \Log::info($request->all());
        \Log::info('add_coop initiated.');

        $data = $request->validate([
            'user_id' => 'nullable',
            'authorized_representative' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:11',
            'email' => 'required|email|max:255|unique:coop',
            'coop_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
            'coop_valid_id_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
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
            'review_status' => 'nullable|string|max:255',
            'date' => 'nullable|date'
        ]);

        $data['user_id'] = $data['user_id'] ?? 'temp-id';
        $data['user_role'] = $data['user_role'] ?? 'Coop';
        $data['date'] = $data['date'] ?? date('Y-m-d');
        $data['status'] = $data['status'] ?? '0';
        $data['review_status'] = $data['review_status'] ?? 'For Review';

        $filename = $data['username'];
        $filename_sanitized = preg_replace('/[^A-Za-z0-9]/', '', $filename);
        if ($request->hasFile('coop_profile_picture')) {
            $data['profile_picture'] = ImageResizer::resizeAndSaveImage($request->file('coop_profile_picture'), 'coop_profile_picture', $filename_sanitized);
        }

        // Handle and resize valid ID picture
        if ($request->hasFile('coop_valid_id_picture')) {
            $data['valid_id_picture'] = ImageResizer::resizeAndSaveImage($request->file('coop_valid_id_picture'), 'coop_valid_id_picture', $filename_sanitized);
        }
       

        //encryp password before storing to database
        $data['password'] = bcrypt($data['password']);

        // dd($data);
        CoopModel::create($data);

        // CREATE ID WITH PREFIX (this is after coop create executed above.)
        $id = CoopModel::max('id');
        $newRecord = CoopModel::find($id);
        if ($newRecord === null) {
            // Handle the case when the table is empty
            return response()->json(['message' => 'No records found.'], 404);
        } 
        // dd($newRecord);
        $user_id = Functions::IDGenerator(new CoopModel, 'user_id', 'COOP', 5, $id);
        // dd($user_id);
        // Define the user ID you want to set (e.g., from the request or another source)
        //$userId = $request->input($data_update); // Replace with your logic

        // Update the user_id column
        $newRecord->user_id = $user_id;
        // dd($newRecord);
        $newRecord->save();

        $success = ['status' => 'success'];
        return redirect()->route('admin.pages.coop', $success);
    }
}
