<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Category';
        $data['getRecord'] = Category::getRecord();

        return view('admin.category.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Category  Add';
        return view('admin.category.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:categories',

        ]);
        $category = new Category;

        $nameSlug = trim($request->name);

        $category->name = trim($request->name);
        $category->slug = Str::slug($nameSlug, "-");
        $category->meta_title = trim($request->meta_title);
        $category->meta_keyword = trim($request->meta_keyword);
        $category->meta_description = trim($request->meta_description);
        $category->status = trim($request->status);
        $category->created_by = Auth::user()->id;

        $category->button_name = trim($request->button_name);
        $category->is_home = !empty($request->is_home) ? 1 : 0;
        $category->is_menu = !empty($request->is_menu) ? 1 : 0;

        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $category->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/category/', $fileName);

                $category->image_name = $fileName;
            }
        }

        $category->save();
        return redirect('admin/category/list')->with('success', "Category Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = Category::getSingle($id);
        $data['header_title'] = 'Edit Category';
        return view('admin.category.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'slug' => 'required|unique:categories,slug,' . $id,

        ]);
        $category = Category::getSingle($id);

        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->meta_title = trim($request->meta_title);
        $category->meta_keyword = trim($request->meta_keyword);
        $category->meta_description = trim($request->meta_description);
        $category->status = trim($request->status);

        $category->button_name = trim($request->button_name);
        $category->is_home = !empty($request->is_home) ? 1 : 0;
        $category->is_menu = !empty($request->is_menu) ? 1 : 0;

        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $category->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/category/', $fileName);

                $category->image_name = $fileName;
            }
        }

        $category->save();
        return redirect('admin/category/list')->with('success', "Category Updated Successfully");
    }
    public function delete($id)
    {
        $category = Category::getSingle($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->back()->with('success', "Category Deleted Successfully");
    }
}
