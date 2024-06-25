<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use App\Models\BlogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Blog ';
        $data['getRecord'] = BlogModel::getRecord();

        return view('admin.blog.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Blog   Add';
        $data['getCategory'] = BlogCategoryModel::getRecordActive();

        return view('admin.blog.add', $data);
    }
    public function insert(Request $request)
    {
        // request()->validate([
        //     'slug' => 'required|unique:blog',


        // ]);
        $blog = new BlogModel;
        $blog->blog_category_id = trim($request->blog_category_id);


        $blog->title = trim($request->title);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_keyword = trim($request->meta_keyword);
        $blog->meta_description = trim($request->meta_description);
        $blog->short_description = trim($request->short_description);

        $blog->description = trim($request->description);
        $blog->status = trim($request->status);

        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $blog->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/blog/', $fileName);

                $blog->image_name = $fileName;
            }
        }
        $slug  = Str::slug($request->title);
        $count =  BlogModel::where('slug', $slug)->count();
        if (!empty($count)) {
            $blog->slug = $slug . '-' . $blog->id;
        } else {
            $blog->slug = trim($slug);
        }

        $blog->save();
        return redirect('admin/blog/list')->with('success', "Blog  Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = BlogModel::getSingle($id);
        $data['header_title'] = 'Edit BlogModel';
        $data['getCategory'] = BlogCategoryModel::getRecordActive();

        return view('admin.blog.edit', $data);
    }
    public function update(Request $request, $id)
    {
        // request()->validate([
        //     'slug' => 'required|unique:blog,slug,' . $id,


        // ]);
        $blog = BlogModel::getSingle($id);
        $blog->blog_category_id = trim($request->blog_category_id);
        $blog->title = trim($request->title);
        $blog->slug = trim($request->slug);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_keyword = trim($request->meta_keyword);
        $blog->meta_description = trim($request->meta_description);
        $blog->short_description = trim($request->short_description);

        $blog->description = trim($request->description);
        $blog->status = trim($request->status);



        if (!empty($request->file('image_name'))) {
            if ($request->file('image_name')->isValid()) {

                $file = $request->file('image_name');

                $ext = $file->getClientOriginalExtension();
                $randomStr = $blog->id . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/blog/', $fileName);

                $blog->image_name = $fileName;
            }
        }

        $blog->save();
        return redirect('admin/blog/list')->with('success', "Blog  Updated Successfully");
    }
    public function delete($id)
    {
        $blog = BlogModel::getSingle($id);
        $blog->is_delete = 1;
        $blog->save();

        return redirect()->back()->with('success', "Blog  Deleted Successfully");
    }
}
