<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{AdminModel, CoopModel, MerchantModel, Review_AccountModel, BuyerModel};
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

    // CREATE COOP PAGE
    public function create_coop()
    {
            $data = [
                'title' => 'Registration'
            ];
            return view('admin.pages.create_coop', $data);
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
    // ACTIVATE and DEACTIVATE COOP
    public function approve_coop(Request $request){
        $coop = CoopModel::find($request->id); 
        $coop->status = $request->status;
        $coop->save();
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

    // ACTIVATE and DEACTIVATE Merchant
    public function approve_merchant(Request $request){
        $merchant = MerchantModel::find($request->id); 
        $merchant->status = $request->status;
        $merchant->save();
    }

    // CREATE MERCHANT PAGE
    public function create_merchant(Request $request)
    {
        $data = [
            'title' => 'Create Merchant'
        ];
        return view('admin.pages.create_merchant', $data); //url path in folder resources/views/admin/pages/create_merchant.blade.php
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

    // BUYER PAGE
    public function buyer()
    {
        $buyer = BuyerModel::all();
        $user_id = Auth::user()->user_id;
        $reviews = Review_AccountModel::with('reviewer')->where('reviewer_id', $user_id)->get();

        // $reviews = $account->reviews;
        $data = [
            'title' => 'BUYER',
            'buyer' => $buyer,
            'reviews' => $reviews
        ];
        return view('admin.pages.buyer', $data); //url path in folder resources/views/admin/pages/buyer.blade.php
    }
    // CREATE BUYER PAGE
    public function create_buyer()
    {
            $data = [
                'title' => 'Registration'
            ];
            return view('admin.pages.create_buyer', $data);
        }

    // REVIEW BUYER PAGE
    public function review_buyer(Request $request, $id){
        $buyer = BuyerModel::find($id); 
        $data = [
            'title' => 'Review Buyer',
            'buyer' => $buyer
        ];
        return view('admin.pages.review_buyer', $data);
    }

    // ACTIVATE and DEACTIVATE BUYER
    public function approve_buyer(Request $request){
        $buyer = BuyerModel::find($request->id); 
        $buyer->status = $request->status;
        $buyer->save();
    }

    // DELETE BUYER
    public function delete_buyer($id){
        $data= BuyerModel::find($id);
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

    // APPROVED REVIEW BUYER PAGE
    public function approved_review_buyer(Request $request, $id){
        $buyer = BuyerModel::find($id);
        // Check if the buyer record exists
        if ($buyer) {
            // Check which button was clicked
            if ($request->has('approved-account-modal')) {
                // Update the approve_buyer column for approval
                $buyer->review_status = 'Approved';
                $notif = 'approved_account';
                // Save the changes to the database
                $buyer->save();
            } elseif ($request->has('denied-account-modal')) {
                // Update the approve_buyer column for denial
                $buyer->review_status = 'In Progress';
                $notif = 'denied_account';
                 // Save the changes to the database
                 $buyer->save();
            }

            

            $status = ['status' => $notif];
            return redirect()->route('pages.buyer', $status); //url path in folder resources/views/admin/pages/buyer.blade.php
        } else {
            $success = ['status' => 'denied_account'];
            return redirect()->route('pages.buyer', $success); //url path in folder resources/views/admin/pages/buyer.blade.php
        }
    }

} //end of controller