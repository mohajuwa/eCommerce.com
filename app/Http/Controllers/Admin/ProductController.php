<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\SubCategory;
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
        $data['getCategory'] = Category::getRecordActive();
        $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();
        $data['header_title'] = 'Product  Add';

        return view('admin.product.add', $data);
    }
    public function insert(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required', // Example validation for category_id
            'sub_category_id' => 'required', // Example validation for sub_category_id
            'sku' => 'required|max:50', // Example validation for sku
            'old_price' => 'nullable|numeric', // Example validation for old_price
            'price' => 'required|numeric', // Example validation for price
            'short_description' => 'required|max:255', // Example validation for short_description
            'description' => 'required', // Example validation for description
            'addetional_information' => 'nullable|max:255', // Example validation for addetional_information
            'shopping_returns' => 'nullable|max:255', // Example validation for shopping_returns
            'status' => 'required|in:0,1', // Example validation for status
        ]);
        $title = trim($request->title);
        $product = new Product;

        $product->title = $title;
        $slug = Str::slug($title, "-");
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku; // Added SKU
        $product->old_price = $request->old_price; // Added Old Price
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->addetional_information = $request->addetional_information;
        $product->shopping_returns = $request->shopping_returns;
        $product->status = $request->status;
        $product->created_by = Auth::user()->id;
        $product->is_trendy = !empty($request->is_trendy) ? 1 : 0;

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

    public function edit($productId)
    {
        $product = Product::getSingle($productId);

        if (!empty($product)) {
            $data['getRecord'] = $product;
            $data['getCategory'] = Category::getRecordActive();
            $data['getSubCategory'] = SubCategory::getRecordSubCategory($product->category_id);
            $data['getColor'] = Color::getRecordActive();
            $data['product'] = $product;
            $data['getBrand'] = Brand::getRecordActive();
            $data['header_title'] = 'Edit Product';

            return view('admin.product.edit', $data);
        }
    }
    public function update(Request $request, $productId)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required', // Example validation for category_id
            'sub_category_id' => 'required', // Example validation for sub_category_id
            'sku' => 'required|max:50', // Example validation for sku
            'old_price' => 'nullable|numeric', // Example validation for old_price
            'price' => 'required|numeric', // Example validation for price
            'short_description' => 'required|max:255', // Example validation for short_description
            'description' => 'required', // Example validation for description
            'addetional_information' => 'nullable|max:255', // Example validation for addetional_information
            'shopping_returns' => 'nullable|max:255', // Example validation for shopping_returns
            'status' => 'required|in:0,1', // Example validation for status
        ]);

        $product = Product::getSingle($productId);

        if (!empty($product)) {
            $product->title = trim($request->title);
            $product->category_id = trim($request->category_id);
            $product->sub_category_id = trim($request->sub_category_id);
            $product->brand_id = trim($request->brand_id);
            $product->sku = trim($request->sku); // Added SKU
            if (empty($request->slug)) {
                $product->slug = Str::slug($request->title, "-");
            } else {
                $product->slug = Str::slug($request->slug); // Added Slug

            }
            $product->old_price = !empty($request->old_price) ? $request->old_price : 0; // Added Old Price
            $product->price = trim($request->price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->addetional_information = trim($request->addetional_information);
            $product->shopping_returns = trim($request->shopping_returns);
            $product->status = trim($request->status);
            $product->is_trendy = !empty($request->is_trendy) ? 1 : 0;

            $product->save();
            ProductColor::DeleteRecord($product->id);
            if (!empty($request->color_id)) {
                foreach ($request->color_id as $colorId) {
                    $color = new ProductColor;
                    $color->color_id = $colorId;
                    $color->product_id = $product->id;
                    $color->save();
                }
            }
            ProductSize::DeleteRecord($product->id);
            if (!empty($request->size)) {
                foreach ($request->size as $sizeItem) {

                    if (!empty($sizeItem['name'])) {
                        $saveSize = new ProductSize;
                        $saveSize->name = $sizeItem['name'];
                        $saveSize->price = !empty($sizeItem['price']) ? $sizeItem['price'] : 0;
                        $saveSize->product_id = $product->id;
                        $saveSize->save();
                    }
                }
            }
            if (!empty($request->file('image'))) {
                foreach ($request->file('image') as $image) {
                    if ($image->isValid()) {
                        $ext = $image->getClientOriginalExtension();
                        $randomStr = $product->id . Str::random(20);
                        $fileName = strtolower($randomStr) . '.' . $ext;
                        $image->move('upload/product/', $fileName);

                        $imageUpload = new ProductImage;
                        $imageUpload->image_name = $fileName;
                        $imageUpload->image_extension = $ext;
                        $imageUpload->product_id = $product->id;
                        $imageUpload->save();
                    } else {
                        redirect()->back()->with('error', "Image not valid");
                    }
                }
            }
            return redirect('admin/product/list')->with('success', "Product Updated Successfully");
        } else {
            abort(404);
        }
    }
    public function delete($productId)
    {
        $product = Product::getSingle($productId);
        $product->is_delete = 1;
        $product->save();

        return redirect()->back()->with('success', "Product Deleted Successfully");
    }
    public function imageDelete($productId)
    {
        $productImage = ProductImage::getSingle($productId);

        if (!empty($productImage->getImage())) {
            unlink('upload/product/' . $productImage->image_name);
        }

        $productImage->delete();

        return redirect()->back()->with('success', "Product Image Deleted Successfully");
    }
    public function productImageSortable(Request $request)
    {
        if (!empty($request->photo_id)) {
            $i = 1;
            foreach ($request->photo_id as $photoId) {
                $image = ProductImage::getSingle($photoId);
                $image->order_by = $i;
                $image->save();
                $i++;
            }
        }
        $json['success'] = true;
        echo json_encode($json);
    }
}
