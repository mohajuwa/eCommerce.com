<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Slider';
        $data['getRecord'] = SliderModel::getRecord();

        return view('admin.slider.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Slider  Add';
        return view('admin.slider.add', $data);
    }
    public function insert(Request $request)
    {


        $slider = new SliderModel;

        $slider->title = trim($request->title);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);

        $slider->status = trim($request->status);
        $slider->save();

        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $slider->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/slider/', $fileName);

                $slider->image_name = $fileName;
                $slider->save();
            }
        }


        return redirect('admin/slider/list')->with('success', "Slider Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = SliderModel::getSingle($id);
        $data['header_title'] = 'Edit Slider';
        return view('admin.slider.edit', $data);
    }
    public function update(Request $request, $id)
    {
        
        $slider = SliderModel::getSingle($id);

        $slider->title = trim($request->title);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);


        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $slider->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/slider/', $fileName);

                $slider->image_name = $fileName;
            }
        }
        $slider->status = trim($request->status);
        $slider->save();
        return redirect('admin/slider/list')->with('success', "Slider Updated Successfully");
    }
    public function delete($id)
    {
        $slider = SliderModel::getSingle($id);
        $slider->is_delete = 1;
        $slider->save();

        return redirect()->back()->with('success', "Slider Deleted Successfully");
    }
}
