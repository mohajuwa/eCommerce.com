<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductReviewModel;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategory($slug, $subSlug = '')
    {

        $getCategory = Category::getSingleSlug($slug);
        $getSubCategory = SubCategory::getSingleSlug($subSlug);

        // $data['getSize'] = ProductSize::getColors();

        $data['getBrand'] = Brand::getRecordActive();
        $getProductSingle = Product::getSingleSlug($slug);
        // $getColors = $getProductSingle;

        if (!empty($getProductSingle)) {
            // $data['getColors'] = Color::getAllColors($getColors->color_id);

            $data['meta_title'] = $getProductSingle->meta_title;
            $data['meta_description'] = $getProductSingle->meta_description;
            $data['getProduct'] = $getProductSingle;
            $data['getRelatedProducts'] = Product::getRelatedProducts($getProductSingle->id, $getProductSingle->sub_category_id);
            $data['getReviewProduct'] = ProductReviewModel::getReviewProduct($getProductSingle->id);
            return view('product.detail', $data);
        } else if (!empty($getCategory) && !empty($getSubCategory)) {
            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);

            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_keywords'] = $getSubCategory->meta_keyword;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;
            $getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);
            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());
                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            $data['page'] = $page;
            $data['getProduct'] = $getProduct;
            return view('product.list', $data);
        } else if (!empty($getCategory)) {
            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);
            // dd($data['getSubCategoryFilter']);
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_keywords'] = $getCategory->meta_keyword;
            $data['meta_description'] = $getCategory->meta_description;
            $data['getCategory'] = $getCategory;
            $getProduct = Product::getProduct($getCategory->id);
            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());
                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;
            $data['getProduct'] = $getProduct;
            return view('product.list', $data);
        } else {
            abort(404);
        }
    }
    public function getProdcutFIlterAjax(Request $request)
    {
        $getProduct = Product::getProduct();
        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl());
            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }
        return response()->json(
            [
                "status" => true,
                "page" => $page,
                "success" => view('product._list', [
                    "getProduct" => $getProduct,
                    "page" => $page,

                ])->render(),
            ],
            200
        );
    }

    public function getProductSearch(Request $request)
    {
        // dd($data['getSubCategoryFilter']);
        $data['meta_title'] = 'Search';
        $data['meta_keywords'] = 'Search';
        $data['meta_description'] = 'Search';
        $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();
        $getProduct = Product::getProduct();
        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl());
            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }
        $data['page'] = $page;
        $data['getProduct'] = $getProduct;
        return view('product.list', $data);
    }
}
