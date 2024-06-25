<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Partner';
        $data['getRecord'] = PartnerModel::getRecord();

        return view('admin.partner.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Partner  Add';
        return view('admin.partner.add', $data);
    }
    public function insert(Request $request)
    {


        $partner = new PartnerModel;

        $partner->button_name = trim($request->button_name);
        $partner->button_link = trim($request->button_link);

        $partner->status = trim($request->status);

        $partner->save();

        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $partner->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/partner/', $fileName);

                $partner->image_name = $fileName;
                $partner->save();
            }
        }


        return redirect('admin/partner/list')->with('success', "Partner Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = PartnerModel::getSingle($id);
        $data['header_title'] = 'Edit Partner';
        return view('admin.partner.edit', $data);
    }
    public function update(Request $request, $id)
    {

        $partner = PartnerModel::getSingle($id);

        $partner->button_name = trim($request->button_name);
        $partner->button_link = trim($request->button_link);


        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $partner->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/partner/', $fileName);

                $partner->image_name = $fileName;
            }
        }
        $partner->status = trim($request->status);
        $partner->save();
        return redirect('admin/partner/list')->with('success', "Partner Updated Successfully");
    }
    public function delete($id)
    {
        $partner = PartnerModel::getSingle($id);
        $partner->is_delete = 1;
        $partner->save();

        return redirect()->back()->with('success', "Partner Deleted Successfully");
    }
}
