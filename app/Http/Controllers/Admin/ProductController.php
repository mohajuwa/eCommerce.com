<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Product';
        $data['getRecord'] = Product::getRecord();


        return view('admin.product.list', $data);
    }
    public function add()
    {
        $data['getCategory'] = Category::getRecord();

        $data['header_title'] = 'Product  Add';

        return view('admin.product.add', $data);
    }
    public function insert(Request $request)
    {

        $title = trim($request->title);
        $product = new Product;

        $product->title =  $title;
        $slug = Str::slug($title, "-");


        $product->created_by = Auth::user()->id;

        $checkSlug = Product::checkSlug($slug);
        $product->save();

        if (empty($checkSlug)) {
            $product->slug = $slug;
            $product->save();
        } else {
            $new_slug = $slug . '-' . $product->id;
            $product->slug = $new_slug;
            $product->save();
        }


        return redirect('admin/product/list')->with('success', "Product Created Successfully");
    }
    public function edit($id)
    {
        $data['getRecord'] = Product::getSingle($id);
        // $data['getCategory'] = Category::getRecord();

        $data['header_title'] = 'Edit Product';
        return view('admin.product.edit', $data);
    }
    public function update(Request $request, $id)
    {
        // request()->validate([
        //     'slug' => 'required|unique:product,slug,' . $id,
        //     'name' => 'required|max:255',
        //     'meta_title' => 'required|max:255',


        // ]);
        $product =  Product::getSingle($id);


        $product->name = trim($request->name);
        $product->category_id = $request->category_id;
        $product->slug = trim($request->slug);
        $product->meta_title = trim($request->meta_title);
        $product->meta_keyword = trim($request->meta_keyword);
        $product->meta_description = trim($request->meta_description);
        $product->status = trim($request->status);
        $product->save();
        return redirect('admin/product/list')->with('success', "Product Updated Successfully");
    }
    public function delete($id)
    {
        $product =  Product::getSingle($id);
        $product->is_delete = 1;
        $product->save();

        return redirect()->back()->with('success', "Product Deleted Successfully");
    }
}
