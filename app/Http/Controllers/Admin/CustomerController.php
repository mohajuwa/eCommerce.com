<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function customerList(Request $request)
    {

        if (!empty($request->noti_id)) {
            NotificationModel::updateReadNoti($request->noti_id);

        }
        $data['header_title'] = 'Customer';
        $data['getRecord'] = User::getCustomer();

        return view('admin.custom.list', $data);
    }
    public function customerAdd()
    {
        $data['header_title'] = 'Customer  Add';
        return view('admin.custom.add', $data);
    }
    public function customerInsert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->is_admin = 1;

        $user->save();
        return redirect('admin/customer/list')->with('success', "Customer Created Successfully");
    }
    public function customerEdit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['header_title'] = 'Edit Customer';
        return view('admin.custom.edit', $data);
    }
    public function customerUpdate(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $user = User::getSingle($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->is_admin = 1;

        $user->save();
        return redirect('admin/customer/list')->with('success', "Customer Updated Successfully");
    }
    public function customerDelete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success', "Customer Deleted Successfully");
    }
}
