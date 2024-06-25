<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Shippinge Charge';
        $data['getRecord'] = ShippingChargeModel::getRecord();

        return view('admin.shippingCharge.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Shippinge Charge  Add';
        return view('admin.shippingCharge.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',

        ]);

        $shippingCharge = new ShippingChargeModel;

        $shippingCharge->name = trim($request->name);
        $shippingCharge->price = trim($request->price);

        $shippingCharge->status = trim($request->status);

        $shippingCharge->save();

        return redirect('admin/shipping_charge/list')->with('success', "Shippinge Charge Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = ShippingChargeModel::getSingle($id);
        $data['header_title'] = 'Edit Shippinge Charge';
        return view('admin.shippingCharge.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',

        ]);
        $shippingCharge = ShippingChargeModel::getSingle($id);

        $shippingCharge->name = trim($request->name);
        $shippingCharge->price = trim($request->price);

        $shippingCharge->status = trim($request->status);
        $shippingCharge->save();
        return redirect('admin/shipping_charge/list')->with('success', "Shippinge Charge Updated Successfully");
    }
    public function delete($id)
    {
        $shippingCharge = ShippingChargeModel::getSingle($id);
        $shippingCharge->is_delete = 1;
        $shippingCharge->save();

        return redirect()->back()->with('success', "Shippinge Charge Deleted Successfully");
    }

}
