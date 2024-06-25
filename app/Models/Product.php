<?php

namespace App\Models;

use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable =
    [
        'category_id',
        'sub_category_id',
        'brand_id',
        'title',
        'slug',
        'old_price',
        'price',
        'short_description',
        'description',
        'addetional_information',
        'shopping_returns',
        'status',
        'created_by',
        'is_delete',

    ];

    public static function getMyWishlist($userId)
    {
        $return = Product::select('product.*')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('product_wishlist', 'product_wishlist.product_id', '=', 'product.id')
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->where('product_wishlist.user_id', '=', $userId)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->paginate(30);

        return $return;
    }
    public static function checkWishlist($product_id)
    {
        return WishlistModel::checkAlready($product_id, Auth::user()->id);
    }
    public static function checkSlug($slug)
    {
        return self::where('slug', $slug)->count();
    }
    public static function getSingleSlug($slug)
    {

        return self::where('slug', $slug)
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->first();
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getRecord()
    {
        return self::select(
            'product.*',
            'users.name as created_by_name',
            'categories.name as category_name',
            'brand.name as brand_name'
        )
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->where('product.is_delete', '=', 0)
            ->orderBy('product.id', 'desc')
            ->paginate(50);
    }
    public static function getRecordActive()
    {
        return self::select('product.*')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->orderBy('product.id', 'asc')
            ->get();
    }

    public static function getRelatedProducts($prodId, $subCateId)
    {
        $return = Product::select(
            'product.*',
            'users.name as created_by_name',
            'categories.name as category_name',
            'categories.slug as category_slug',
            'sub_categories.name as sub_category_name',
            'sub_categories.slug as sub_category_slug',
            'brand.name as brand_name'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->where('product.id', '!=', $prodId)
            ->where('product.sub_category_id', '=', $subCateId)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->limit(10)
            ->get();

        return $return;
    }

    public static function getProduct($cateId = '', $subCateId = '')
    {
        $return = Product::select(
            'product.*',
            'users.name as created_by_name',
            'categories.name as category_name',
            'categories.slug as category_slug',
            'sub_categories.name as sub_category_name',
            'sub_categories.slug as sub_category_slug',
            'brand.name as brand_name'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id');
        if (!empty($cateId)) {

            $return = $return->where('product.category_id', '=', $cateId);
        }
        if (!empty($subCateId)) {
            $return = $return->where('product.sub_category_id', '=', $subCateId);
        }
        if (!empty(Request::get('sub_category_id'))) {
            $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
            $sub_category_id_array = explode(',', $sub_category_id);
            $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
        } else {
            if (!empty(Request::get('old_category_id'))) {

                $return = $return->where('product.category_id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
            }
        }
        if (!empty(Request::get('color_id'))) {
            $color_id = rtrim(Request::get('color_id'), ',');

            $color_id_array = explode(',', $color_id);

            $return = $return->join(
                'product_color',
                'product_color.product_id',
                '=',
                'product.id'
            );
            $return = $return->whereIn('product_color.color_id', $color_id_array);
        }
        if (!empty(Request::get('brand_id'))) {
            $brand_id = rtrim(Request::get('brand_id'), ',');
            $brand_id_array = explode(',', $brand_id);
            $return = $return->whereIn('product.brand_id', $brand_id_array);
        }
        if (!empty(Request::get('price_start')) && !empty(Request::get('price_end'))) {
            $start_price = str_replace('$', '', Request::get('price_start'));
            $end_price = str_replace('$', '', Request::get('price_end'));
            $return = $return
                ->where('product.price', '>=', $start_price)
                ->where('product.price', '<=', $end_price);
        }
        if (!empty(Request::get('q'))) {
            $query = Request::get('q');
            $return = $return->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('product.title', 'like', '%' . $query . '%')
                    ->orWhere('product.description', 'like', '%' . $query . '%')
                    ->orWhere('product.short_description', 'like', '%' . $query . '%');
            });
        }

        $return = $return->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->paginate(30);

        return $return;
    }

    public static function getProductTrendy()
    {
        $return = Product::select(
            'product.*',
            'users.name as created_by_name',
            'categories.name as category_name',
            'categories.slug as category_slug',
            'sub_categories.name as sub_category_name',
            'sub_categories.slug as sub_category_slug'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->where('product.is_trendy', '=', 1);
        $return = $return->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->limit(20)
            ->get();

        return $return;
    }
    public static function getRecentArrival()
    {
        $return = Product::select(
            'product.*',
            'users.name as created_by_name',
            'categories.name as category_name',
            'categories.slug as category_slug',
            'sub_categories.name as sub_category_name',
            'sub_categories.slug as sub_category_slug'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0);
        if (!empty(Request::get('category_id'))) {
            $return = $return->where('product.category_id', '=', Request::get('category_id'));
        }
        $return = $return->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->limit(8)
            ->get();

        return $return;
    }
    public static function getImageSingle($productId)
    {
        return ProductImage::where('product_id', "=", $productId)->orderBy('order_by', 'asc')->first();
    }
    public function getColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }
    public function colorsGet()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    public function getSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function getImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by', 'asc');
    }

    public function getCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getSubCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function getTotalReview()
    {
        return $this->hasMany(ProductReviewModel::class, 'product_id')
            ->join('users', 'users.id', '=', 'product_review.user_id')
            ->count();
    }

    public function getReviewRating($product_id)
    {
        $avgRating = ProductReviewModel::getRatingAVG($product_id);

        // Ensure the average rating is within the valid range (0 to 5)
        $avgRating = max(0, min(5, $avgRating));

        // Convert the average rating to a percentage
        $percentage = ($avgRating / 5) * 100;

        // Ensure the percentage is within the valid range (0 to 100)
        return max(0, min(100, $percentage));
    }
}
