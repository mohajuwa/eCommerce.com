<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Brand';
        $data['getRecord'] = Brand::getRecord();


        return view('admin.brand.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Brand  Add';
        return view('admin.brand.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',



        ]);
        $name = trim($request->name);
        
        $brand = new Brand;

        $brand->name = $name;
        $slug = Str::slug($name, "-");
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_keyword = trim($request->meta_keyword);
        $brand->meta_description = trim($request->meta_description);
        $brand->created_by = Auth::user()->id;

        $checkSlug = Brand::checkSlug($slug);
        $brand->save();

        if (empty($checkSlug)) {
            $brand->slug = $slug;
            $brand->save();
        } else {
            $new_slug = $slug . '-' . $brand->id;
            $brand->slug = $new_slug;
            $brand->save();
        }
        $brand->status = trim($request->status);
        $brand->save();
        return redirect('admin/brand/list')->with('success', "Brand Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = Brand::getSingle($id);
        $data['header_title'] = 'Edit Brand';
        return view('admin.brand.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',



        ]);
        $brand =  Brand::getSingle($id);


        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_keyword = trim($request->meta_keyword);
        $brand->meta_description = trim($request->meta_description);
        $brand->status = trim($request->status);
        $brand->save();
        return redirect('admin/brand/list')->with('success', "Brand Updated Successfully");
    }
    public function delete($id)
    {
        $brand =  Brand::getSingle($id);
        $brand->is_delete = 1;
        $brand->save();

        return redirect()->back()->with('success', "Brand Deleted Successfully");
    }
}
