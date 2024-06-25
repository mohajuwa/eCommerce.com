<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\Product;
use App\Models\ProductReviewModel;
use App\Models\User;
use App\Models\WishlistModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {

        $data['meta_title'] = 'Dashboard';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['TotalOrders'] = OrderModel::getTotalOrdersUser(Auth::user()->id);
        $data['TodayTotalOrders'] = OrderModel::getTodayTotalOrdersUser(Auth::user()->id);

        $data['TotalAmount'] = OrderModel::getTotalAmountUser(Auth::user()->id);
        $data['TodayTotalAmount'] = OrderModel::getTodayTotalAmountUser(Auth::user()->id);

        $data['TotalPending'] = OrderModel::getTotalStatusUser(Auth::user()->id, 0);
        $data['TotalInprogress'] = OrderModel::getTotalStatusUser(Auth::user()->id, 1);
        $data['TotalDelivered'] = OrderModel::getTotalStatusUser(Auth::user()->id, 2);
        $data['TotalComplated'] = OrderModel::getTotalStatusUser(Auth::user()->id, 3);
        $data['TotalCancelled'] = OrderModel::getTotalStatusUser(Auth::user()->id, 4);

        return view('user.dashboard', $data);
    }

    public function orders()
    {

        $data['meta_title'] = 'Orders';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['getRecord'] = OrderModel::getRecordUser(Auth::user()->id);

        return view('user.orders', $data);
    }
    public function orderDetail($orderId)
    {

        $data['getRecord'] = OrderModel::getSinglelUser(Auth::user()->id, $orderId);
        if (!empty($data['getRecord'])) {
            $data['meta_title'] = 'Orders Detail';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';

            return view('user.orders_detail', $data);

        } else {
            abort(404);
        }

    }

    public function editProfile()
    {
        $data['meta_title'] = 'Edit Profile';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getRecord'] = User::getSingle(Auth::user()->id);

        return view('user.edit_profile', $data);

    }
    public function updateProfile(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        $user->name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->company_name = trim($request->company_name);
        $user->country = trim($request->country);
        $user->address_one = trim($request->address_one);
        $user->address_two = trim($request->address_two);
        $user->city = trim($request->city);
        $user->state = trim($request->state);
        $user->post_code = trim($request->post_code);
        $user->phone = trim($request->phone);
        $user->note = trim($request->note);
        $user->save();

        return redirect()->back()->with('success', "Profile updated successfully");
    }

    public function changePassword()
    {

        $data['meta_title'] = 'Change Password';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('user.change_password', $data);
    }
    public function updatePassword(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->password == $request->cpassword) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', "Password updated successfully");

            } else {
                return redirect()->back()->with('error', "New Password dose not match with confirm password");

            }

        } else {
            return redirect()->back()->with('error', "Old Password is not correct");

        }

    }
    public function addToWishList(Request $request)
    {
        $check = WishlistModel::checkAlready($request->product_id, Auth::user()->id);

        if (empty($check)) {
            $save = new WishlistModel;
            $save->product_id = $request->product_id;
            $save->user_id = Auth::user()->id;
            $save->save();

            $json['is_wishlist'] = 1;
        } else {

            $check = WishlistModel::DeleteRecord($request->product_id, Auth::user()->id);
            $json['is_wishlist'] = 0;

        }

        $json['status'] = true;
        $json['message'] = "Success";

        echo json_encode($json);

    }
    public function myWishlist()
    {
        $data['meta_title'] = 'My Wishlist';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['getProduct'] = Product::getMyWishlist(Auth::user()->id);
        return view('product.my_wishlist', $data);
    }
    public function submitReview(Request $request)
    {
        $save = new ProductReviewModel;
        $save->product_id = trim($request->product_id);
        $save->order_id = trim($request->order_id);
        $save->user_id = Auth::user()->id;
        $save->rating = trim($request->rating);
        $save->review = trim($request->review);

        $save->save();

        return redirect()->back()->with('success', 'Thanks for your review.');

    }

}
