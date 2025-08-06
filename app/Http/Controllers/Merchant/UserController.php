<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_Data\{MerchantModel};
use App\Helpers\Functions;
use App\Models\Admin_Data\{CoopModel, BuyerModel, Review_AccountModel};
use Illuminate\Support\Facades\Auth;
use Closure;

class UserController extends Controller
{

    public function merchant()
    {
        $merchant = MerchantModel::all();
        $data = [
            'title' => 'Merchant',
            'merchant' => $merchant
        ];
        return view('merchant.pages-merchant', $data); //url path in folder resources/views/merchant/pages/merchant.blade.php
    }

    public function merchant_review(){

        $coop = CoopModel::all();
        $buyer = BuyerModel::all();
        $reviews = Review_AccountModel::with('reviewer')->get();

        $user_id = Auth::user()->user_id;

        $data = [
            'title' => 'Review',
            'coop' => $coop,
            'buyer' => $buyer,
            'reviews' => $reviews
        ];
        return view('merchant.pages-review', $data); //url path in folder resources/views/merchant/pages/review.blade.php
    }

    // COOP PAGE
    public function merchant_coop()
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
        return view('merchant.pages.coop', $data); //url path in folder resources/views/merchant/pages/coop.blade.php
    }
    

    // REVIEW COOP PAGE
    public function merchant_review_coop(Request $request, $id){
        $coop = CoopModel::find($id); 
        $data = [
            'title' => 'Review Coop',
            'coop' => $coop
        ];
        return view('merchant.pages.review_coop', $data);
    }
    // ACTIVATE and DEACTIVATE COOP
    public function merchant_approve_coop(Request $request){
        $coop = CoopModel::find($request->id); 
        $coop->status = $request->status;
        $coop->save();
    }

    // DELETE COOP
    public function merchant_delete_coop($id){
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
    public function merchant_approved_review_coop(Request $request, $id){
        $user = Auth::user();
        $user_id = $user->user_id; // Get the user ID of the currently authenticated user
        $coop = CoopModel::find($id);
        // Check if the coop record exists
        if ($coop) {
        // Check which button was clicked
            if ($request->has('approved-account-modal')) {
                // Update the approve_coop column for approval
                $coop->review_status = 'Approved';
                $coop->reviewed_by = $user_id;
                $notif = 'approved_account';
                // Save the changes to the database
                $coop->save();
            } elseif ($request->has('denied-account-modal')) {
                // Update the approve_coop column for denial
                $coop->review_status = 'In Progress';
                $coop->reviewed_by = $user_id;
                $notif = 'denied_account';
                // Save the changes to the database
                $coop->save();
            }

            

            $status = ['status' => $notif];
            return redirect()->route('merchant.pages.coop', $status); //url path in folder resources/views/merchant/pages/coop.blade.php
        } else {
            $success = ['status' => 'denied_account'];
            return redirect()->route('merchant.pages.coop', $success); //url path in folder resources/views/merchant/pages/coop.blade.php
        }
    }

    // BUYER PAGE
    public function merchant_buyer()
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
        return view('merchant.pages.buyer', $data); //url path in folder resources/views/merchant/pages/buyer.blade.php
    }

    // REVIEW BUYER PAGE
    public function merchant_review_buyer(Request $request, $id){
        $buyer = BuyerModel::find($id); 
        $data = [
            'title' => 'Review Buyer',
            'buyer' => $buyer
        ];
        return view('merchant.pages.review_buyer', $data);
    }

    // ACTIVATE and DEACTIVATE BUYER
    public function merchant_approve_buyer(Request $request){
        $buyer = BuyerModel::find($request->id); 
        $buyer->status = $request->status;
        $buyer->save();
    }

    // DELETE BUYER
    public function merchant_delete_buyer($id){
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
    public function merchant_approved_review_buyer(Request $request, $id){
        $user = Auth::user();
        $user_id = $user->user_id; // Get the user ID of the currently authenticated user
        $buyer = BuyerModel::find($id);
        // Check if the buyer record exists
        if ($buyer) {
            // Check which button was clicked
            if ($request->has('approved-account-modal')) {
                // Update the approve_buyer column for approval
                $buyer->review_status = 'Approved';
                $buyer->reviewed_by = $user_id;
                $notif = 'approved_account';
                // Save the changes to the database
                $buyer->save();
            } elseif ($request->has('denied-account-modal')) {
                // Update the approve_buyer column for denial
                $buyer->review_status = 'In Progress';
                $buyer->reviewed_by = $user_id;
                $notif = 'denied_account';
                 // Save the changes to the database
                 $buyer->save();
            }

            

            $status = ['status' => $notif];
            return redirect()->route('merchant.pages.buyer', $status); //url path in folder resources/views/merchant/pages/buyer.blade.php
        } else {
            $success = ['status' => 'denied_account'];
            return redirect()->route('merchant.pages.buyer', $success); //url path in folder resources/views/merchant/pages/buyer.blade.php
        }
    }

}
