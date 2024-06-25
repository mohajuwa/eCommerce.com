<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCodeModel;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'DiscountCode';
        $data['getRecord'] = DiscountCodeModel::getRecord();

        return view('admin.discount.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'DiscountCode  Add';
        return view('admin.discount.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',

        ]);

        $discountCode = new DiscountCodeModel;

        $discountCode->name = trim($request->name);
        $discountCode->type = trim($request->type);
        $discountCode->precent_amount = trim($request->precent_amount);
        $discountCode->expare_date = trim($request->expare_date);
        $discountCode->status = trim($request->status);

        $discountCode->save();

        return redirect('admin/discount_code/list')->with('success', "DiscountCode Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = DiscountCodeModel::getSingle($id);
        $data['header_title'] = 'Edit DiscountCode';
        return view('admin.discount.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',

        ]);
        $discountCode = DiscountCodeModel::getSingle($id);

        $discountCode->name = trim($request->name);
        $discountCode->type = trim($request->type);
        $discountCode->precent_amount = trim($request->precent_amount);
        $discountCode->expare_date = trim($request->expare_date);
        $discountCode->status = trim($request->status);
        $discountCode->save();
        return redirect('admin/discount_code/list')->with('success', "DiscountCode Updated Successfully");
    }
    public function delete($id)
    {
        $discountCode = DiscountCodeModel::getSingle($id);
        $discountCode->is_delete = 1;
        $discountCode->save();

        return redirect()->back()->with('success', "DiscountCode Deleted Successfully");
    }

}
