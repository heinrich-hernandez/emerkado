<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{AdminModel, CoopModel, MerchantModel, Review_AccountModel};
use App\Helpers\Functions;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageResizer;

class UserController extends Controller
{

    // COOP PAGE
    public function coop()
    {
        $coop = CoopModel::all();
        $user_id = Auth::user()->user_id;
        $reviews = Review_AccountModel::with('reviewer')->where('reviewer_id', $user_id)->get();

        // $reviews = $account->reviews;
        $data = [
            'title' => 'COOP',
            'coop' => $coop,
            'reviews' => $reviews
        ];
        return view('admin.pages.coop', $data); //url path in folder resources/views/admin/pages/coop.blade.php
    }

    // MERCHANT PAGE
    public function merchant()
    {
        $merchant = MerchantModel::all();
        $user_id = Auth::user()->user_id;
        $data = [
            'title' => 'Merchant',
            'merchant' => $merchant
        ];
        return view('admin.pages.merchant', $data); //url path in folder resources/views/admin/pages/merchant.blade.php
    }


    // DELETE COOP
    public function delete_coop($id){
        $data= CoopModel::find($id);
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }

        // Delete the profile_picture
        if ($data->profile_picture && file_exists(public_path('storage/'.$data->profile_picture))) {
            unlink(public_path('storage/'.$data->profile_picture));
        }


        // Delete the valid_picture
        if ($data->valid_id_picture && file_exists(public_path('storage/'.$data->valid_id_picture))) {
            unlink(public_path('storage/'.$data->valid_id_picture));
        }

        $data->delete();
        return response()->json(['success'=>true, 'table_row'=>'table_row_'.$id]);
    }

    // DELETE MERCHANT
    public function delete_merchant($id){
        $data= MerchantModel::find($id);
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }

        // Delete the profile_picture
        if ($data->profile_picture && file_exists(public_path('storage/'.$data->profile_picture))) {
            unlink(public_path('storage/'.$data->profile_picture));
        }


        // Delete the valid_picture
        if ($data->valid_id_picture && file_exists(public_path('storage/'.$data->valid_id_picture))) {
            unlink(public_path('storage/'.$data->valid_id_picture));
        }

        $data->delete();
        return response()->json(['success'=>true, 'table_row'=>'table_row_'.$id]);
    }

    // ACTIVATE and DEACTIVATE COOP
    public function approve_coop(Request $request){
        $coop = CoopModel::find($request->id); 
        $coop->status = $request->status;
        $coop->save();
    }

    // BUYER PAGE
    public function buyer()
    {
        $data = [
            'title' => 'Buyer'
        ];
        return view('admin.pages.buyer', $data); //url path in folder resources/views/admin/pages/buyer.blade.php
    }

    // CREATE COOP PAGE
    public function create_coop()
    {
            $data = [
                'title' => 'Registration'
            ];
            return view('admin.pages.create_coop', $data);
        }

    // CREATE MERCHANT PAGE
    public function create_merchant(Request $request)
    {
        $data = [
            'title' => 'Create Merchant'
        ];
        return view('admin.pages.create_merchant', $data); //url path in folder resources/views/admin/pages/create_merchant.blade.php
    }

    // REVIEW COOP PAGE
    public function review_coop(Request $request, $id){
        $coop = CoopModel::find($id); 
        $data = [
            'title' => 'Review Coop',
            'coop' => $coop
        ];
        return view('admin.pages.review_coop', $data);
    }

    // APPROVED REVIEW COOP PAGE
    public function approved_review_coop(Request $request, $id){
        $coop = CoopModel::find($id);
        // Check if the coop record exists
        if ($coop) {
            // Check which button was clicked
            if ($request->has('approved-account-modal')) {
                // Update the approve_coop column for approval
                $coop->review_status = 'Approved';
                $notif = 'approved_account';
                // Save the changes to the database
                $coop->save();
            } elseif ($request->has('denied-account-modal')) {
                // Update the approve_coop column for denial
                $coop->review_status = 'In Progress';
                $notif = 'denied_account';
                 // Save the changes to the database
                 $coop->save();
            }

            

            $status = ['status' => $notif];
            return redirect()->route('pages.coop', $status); //url path in folder resources/views/admin/pages/coop.blade.php
        } else {
            $success = ['status' => 'denied_account'];
            return redirect()->route('pages.coop', $success); //url path in folder resources/views/admin/pages/coop.blade.php
        }
    }

    // REVIEW MERCHANT PAGE
    public function review_merchant(Request $request, $id){
        $merchant = MerchantModel::find($id); 
        $data = [
            'title' => 'Review merchant',
            'review_merchant' => $merchant
        ];
        return view('admin.pages.review_merchant', $data);
    }

    // APPROVED REVIEW merchant PAGE
    public function approved_review_merchant(Request $request, $id){
        $merchant = merchantModel::find($id);
        // Check if the merchant record exists
        if ($merchant) {
            // Check which button was clicked
            if ($request->has('approved-account-modal')) {
                // Update the approve_merchant column for approval
                $merchant->review_status = 'Approved';
                $notif = 'approved_account';
                // Save the changes to the database
                $merchant->save();
            } elseif ($request->has('denied-account-modal')) {
                // Update the approve_merchant column for denial
                $merchant->review_status = 'In Progress';
                $notif = 'denied_account';
                 // Save the changes to the database
                 $merchant->save();
            }

            

            $status = ['status' => $notif];
            return redirect()->route('pages.merchant', $status); //url path in folder resources/views/admin/pages/merchant.blade.php
        } else {
            $success = ['status' => 'denied_account'];
            return redirect()->route('pages.merchant', $success); //url path in folder resources/views/admin/pages/merchant.blade.php
        }
    }

} //end of controller