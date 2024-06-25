<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Blog Category';
        $data['getRecord'] = BlogCategoryModel::getRecord();

        return view('admin.blog_category.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Blog Category  Add';
        return view('admin.blog_category.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:blog_category',


        ]);
        $blogCategory = new BlogCategoryModel;

        $nameSlug = trim($request->name);

        $blogCategory->name = trim($request->name);
        $blogCategory->slug = Str::slug($nameSlug, "-");
        $blogCategory->meta_title = trim($request->meta_title);
        $blogCategory->meta_keyword = trim($request->meta_keyword);
        $blogCategory->meta_description = trim($request->meta_description);
        $blogCategory->status = trim($request->status);


        $blogCategory->save();
        return redirect('admin/blog_category/list')->with('success', "Blog Category Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = BlogCategoryModel::getSingle($id);
        $data['header_title'] = 'Edit BlogCategoryModel';
        return view('admin.blog_category.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'slug' => 'required|unique:categories,slug,' . $id,


        ]);
        $blogCategory = BlogCategoryModel::getSingle($id);

        $blogCategory->name = trim($request->name);
        $blogCategory->slug = trim($request->slug);
        $blogCategory->meta_title = trim($request->meta_title);
        $blogCategory->meta_keyword = trim($request->meta_keyword);
        $blogCategory->meta_description = trim($request->meta_description);
        $blogCategory->status = trim($request->status);





        $blogCategory->save();
        return redirect('admin/blog_category/list')->with('success', "Blog Category Updated Successfully");
    }
    public function delete($id)
    {
        $blogCategory = BlogCategoryModel::getSingle($id);
        $blogCategory->is_delete = 1;
        $blogCategory->save();

        return redirect()->back()->with('success', "Blog Category Deleted Successfully");
    }
}
