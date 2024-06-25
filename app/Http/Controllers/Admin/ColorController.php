<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Color';
        $data['getRecord'] = Color::getRecord();


        return view('admin.color.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Color  Add';
        return view('admin.color.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',



        ]);
        $name = trim($request->name);

        $color = new Color;

        $color->name = $name;
        $color->created_by = Auth::user()->id;
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin/color/list')->with('success', "Color Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = Color::getSingle($id);
        $data['header_title'] = 'Edit Color';
        return view('admin.color.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',

        ]);
        $color =  Color::getSingle($id);


        $color->name = trim($request->name);
        $color->code = trim($request->code);

        $color->status = trim($request->status);
        $color->save();
        return redirect('admin/color/list')->with('success', "Color Updated Successfully");
    }
    public function delete($id)
    {
        $color =  Color::getSingle($id);
        $color->is_delete = 1;
        $color->save();

        return redirect()->back()->with('success', "Color Deleted Successfully");
    }
}
