<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin_Data\CoopModel; // Assuming you have a Coop model
use App\Models\Admin_Data\MerchantModel; // Assuming you have a Merchant model
use App\Models\Admin_Data\BuyerModel; // Assuming you have a Buyer model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // Added for throwing validation errors

class RegisterController extends Controller
{
    /**
     * Display the initial registration role selection form.
     * This replaces the old showRegistrationForm.
     *
     * @return \Illuminate\View\View
     */
    public function showRoleSelectionForm()
    {
        return view('auth.register'); // This now points to the role selection page
    }

    /**
     * Display the registration form for Coops.
     *
     * @return \Illuminate\View\View
     */
    public function showCoopRegistrationForm()
    {
        return view('auth.coop_register'); // You'll create this blade file
    }

    /**
     * Display the registration form for Merchants.
     *
     * @return \Illuminate\View\View
     */
    public function showMerchantRegistrationForm()
    {
        return view('auth.merchant_register'); // You'll create this blade file
    }

    /**
     * Display the registration form for Buyers.
     *
     * @return \Illuminate\View\View
     */
    public function showBuyerRegistrationForm()
    {
        return view('auth.buyer_register'); // You'll create this blade file
    }

    /**
     * Handle a registration request for a specific user type.
     * This method will need to be called by specific POST routes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $userType The type of user being registered (coop, merchant, buyer)
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request, $userType)
    {
        // Base rules (can be empty if all rules are type-specific)
        $rules = [];

        $specificRules = [];
        switch ($userType) {
            case 'coop':
                $specificRules = [
                    'authorized_representative' => ['required', 'string', 'max:255'],
                    'coop_name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'contact_number' => ['required', 'string', 'max:11'],
                    'email' => ['required', 'email', 'max:255', 'unique:coops'], // Unique within coops table
                    'coop_profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:512'],
                    'coop_valid_id_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:512'],
                    'username' => ['required', 'string', 'max:255', 'unique:coops'], // Unique within coops table
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'confirmed', // Checks for password_confirmation
                        'regex:/[a-z]/',    // at least one lowercase letter
                        'regex:/[A-Z]/',    // at least one uppercase letter
                        'regex:/[0-9]/',    // at least one digit
                        'regex:/[@$!%*?&]/' // at least one special character
                    ],
                    // 'password_confirmation' is handled by 'confirmed' rule on 'password'
                    'agency_affiliation' => ['required', 'string', 'max:255'],
                    'agency_affiliation_name' => ['nullable', 'required_if:agency_affiliation,yes'],
                    'business_discription' => ['nullable', 'string', 'max:255'],
                    // 'user_id' and 'user_role' are typically for the central User model or handled differently,
                    // not directly validated fields for the specific role profile creation.
                ];
                break;
            case 'merchant':
                $specificRules = [
                    'name' => ['required', 'string', 'max:255'], // Assuming 'name' maps to business_name or similar
                    'address' => ['required', 'string', 'max:255'],
                    'contact_number' => ['required', 'string', 'max:11'],
                    'email' => ['required', 'email', 'max:255', 'unique:merchants'], // Unique within merchants table
                    'username' => ['required', 'string', 'max:255', 'unique:merchants'], // Unique within merchants table
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'confirmed',
                        'regex:/[a-z]/',
                        'regex:/[A-Z]/',
                        'regex:/[0-9]/',
                        'regex:/[@$!%*?&]/'
                    ],
                    'merchant_profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:512'],
                    // 'user_id' and 'user_role' are typically for the central User model or handled differently
                ];
                break;
            case 'buyer':
                $specificRules = [
                    'name' => ['required', 'string', 'max:255'], // Assuming 'name' maps to first_name/last_name or a general name
                    'address' => ['required', 'string', 'max:255'],
                    'contact_number' => ['required', 'string', 'max:11'],
                    'email' => ['required', 'email', 'max:255', 'unique:buyers'], // Unique within buyers table
                    'buyer_profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:512'],
                    'buyer_valid_id_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:512'],
                    'username' => ['required', 'string', 'max:255', 'unique:buyers'], // Unique within buyers table
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'confirmed',
                        'regex:/[a-z]/',
                        'regex:/[A-Z]/',
                        'regex:/[0-9]/',
                        'regex:/[@$!%*?&]/'
                    ],
                    // 'user_id' and 'user_role' are typically for the central User model or handled differently
                ];
                break;
            default:
                throw ValidationException::withMessages(['user_type' => 'Invalid user type specified.']);
        }

        $validator = Validator::make($request->all(), array_merge($rules, $specificRules));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file uploads if present
        $coopProfilePicturePath = null;
        $coopValidIdPicturePath = null;
        $buyerProfilePicturePath = null;
        $buyerValidIdPicturePath = null;
        $merchantProfilePicturePath = null;

        if ($request->hasFile('coop_profile_picture')) {
            $coopProfilePicturePath = $request->file('coop_profile_picture')->store('profile_pictures/coop', 'public');
        }
        if ($request->hasFile('coop_valid_id_picture')) {
            $coopValidIdPicturePath = $request->file('coop_valid_id_picture')->store('valid_ids/coop', 'public');
        }
        if ($request->hasFile('buyer_profile_picture')) {
            $buyerProfilePicturePath = $request->file('buyer_profile_picture')->store('profile_pictures/buyer', 'public');
        }
        if ($request->hasFile('buyer_valid_id_picture')) {
            $buyerValidIdPicturePath = $request->file('buyer_valid_id_picture')->store('valid_ids/buyer', 'public');
        }
        if ($request->hasFile('merchant_profile_picture')) {
            $merchantProfilePicturePath = $request->file('merchant_profile_picture')->store('profile_pictures/merchant', 'public');
        }


        // Create the specific role profile first
        $roleProfile = null;
        switch ($userType) {
            case 'coop':
                $roleProfile = Coop::create([
                    'authorized_representative' => $request->authorized_representative,
                    'coop_name' => $request->coop_name,
                    'address' => $request->address,
                    'contact_number' => $request->contact_number,
                    'email' => $request->email,
                    'coop_profile_picture' => $coopProfilePicturePath,
                    'coop_valid_id_picture' => $coopValidIdPicturePath,
                    'username' => $request->username,
                    'agency_affiliation' => $request->agency_affiliation,
                    'agency_affiliation_name' => $request->agency_affiliation_name,
                    'business_discription' => $request->business_discription,
                    // 'user_role' and 'user_id' are not directly stored in Coop model based on your provided fields
                ]);
                break;
            case 'merchant':
                $roleProfile = Merchant::create([
                    'name' => $request->name, // Assuming 'name' field in merchants table
                    'address' => $request->address,
                    'contact_number' => $request->contact_number,
                    'email' => $request->email,
                    'username' => $request->username,
                    'merchant_profile_picture' => $merchantProfilePicturePath,
                    // 'user_role' and 'user_id' are not directly stored in Merchant model
                ]);
                break;
            case 'buyer':
                $roleProfile = Buyer::create([
                    'name' => $request->name, // Assuming 'name' field in buyers table
                    'address' => $request->address,
                    'contact_number' => $request->contact_number,
                    'email' => $request->email,
                    'buyer_profile_picture' => $buyerProfilePicturePath,
                    'buyer_valid_id_picture' => $buyerValidIdPicturePath,
                    'username' => $request->username,
                    // 'user_role' and 'user_id' are not directly stored in Buyer model
                ]);
                break;
        }

        if (!$roleProfile) {
            // Handle error if role profile creation failed
            return redirect()->back()->with('error', 'Failed to create user profile.')->withInput();
        }

        // Create the central User record, linking to the role profile
        $user = User::create([
            'email' => $request->email, // Use email from the specific profile
            'password' => Hash::make($request->password),
            'user_type' => $userType,
            'role_id' => $roleProfile->id, // Link to the newly created profile
            // You might want to store a general name in the User model too, e.g.,
            // 'name' => $request->input('coop_name') ?? $request->input('name') ?? $request->input('username'),
        ]);

        Auth::login($user);

        // Redirect based on the registered user type
        switch ($userType) {
            case 'admin': // If you ever add an admin registration form
                return redirect('/admin/dashboard')->with('success', 'Admin registration successful!');
            case 'coop':
                return redirect('/coop/dashboard')->with('success', 'Coop registration successful!');
            case 'merchant':
                return redirect('/merchant/dashboard')->with('success', 'Merchant registration successful!');
            case 'buyer':
                return redirect('/buyer/dashboard')->with('success', 'Buyer registration successful!');
            default:
                return redirect('/home')->with('success', 'Registration successful!');
        }
    }
}
