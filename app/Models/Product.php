<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\Category;

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
    static public function checkSlug($slug)
    {
        return self::where('slug', $slug)->count();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getRecord()
    {
        return self::select('product.*', 'users.name as created_by_name', 'categories.name as category_name',
        'brand.name as brand_name')
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->where('product.is_delete', '=', 0)
            ->orderBy('product.id', 'desc')
            ->paginate(15);
    }
    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }
    // public function productImages()
    // {
    //     return $this->hasMany(ProductImage::class, 'product_id', 'id');
    // }
    // public function productColors()
    // {
    //     return $this->hasMany(ProductColor::class, 'product_id', 'id');
    // }
}
