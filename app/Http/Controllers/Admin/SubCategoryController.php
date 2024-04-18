<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Sub Category';
        $data['getRecord'] = SubCategory::getRecord();


        return view('admin.subcategory.list', $data);
    }
    public function add()
    {
        $data['getCategory'] = Category::getRecord();

        $data['header_title'] = 'Sub Category  Add';

        return view('admin.subcategory.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:sub_categories',
            'name' => 'required|max:255',
            'meta_title' => 'required|max:255',


        ]);
        $sub_category = new SubCategory;


        $sub_category->name = trim($request->name);
        $sub_category->slug = trim($request->slug);
        $sub_category->category_id = $request->category_id;
        $sub_category->meta_title = trim($request->meta_title);
        $sub_category->meta_keyword = trim($request->meta_keyword);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->status = trim($request->status);
        $sub_category->created_by = Auth::user()->id;
        $sub_category->save();
        return redirect('admin/sub_category/list')->with('success', "Sub Category Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = SubCategory::getSingle($id);
        $data['getCategory'] = Category::getRecord();

        $data['header_title'] = 'Edit Sub Category';
        return view('admin.subcategory.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'slug' => 'required|unique:sub_categories,slug,' . $id,
            'name' => 'required|max:255',
            'meta_title' => 'required|max:255',


        ]);
        $sub_category =  SubCategory::getSingle($id);


        $sub_category->name = trim($request->name);
        $sub_category->category_id = $request->category_id;
        $sub_category->slug = trim($request->slug);
        $sub_category->meta_title = trim($request->meta_title);
        $sub_category->meta_keyword = trim($request->meta_keyword);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->status = trim($request->status);
        $sub_category->save();
        return redirect('admin/sub_category/list')->with('success', "Sub Category Updated Successfully");
    }
    public function delete($id)
    {
        $sub_category =  SubCategory::getSingle($id);
        $sub_category->is_delete = 1;
        $sub_category->save();

        return redirect()->back()->with('success', "Sub Category Deleted Successfully");
    }
}
