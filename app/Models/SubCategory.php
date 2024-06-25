<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        'is_delete',
        'created_by',

    ];

    public static function getRecord()
    {
        return self::select('sub_categories.*', 'users.name as created_by_name', 'categories.name as category_name')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->orderBy('sub_categories.id', 'desc')
            ->paginate(50);
    }
    public static function getRecordSubCategory($category_id)
    {
        return self::select('sub_categories.*')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->where('sub_categories.status', '=', 0)
            ->where('sub_categories.category_id', '=', $category_id)
            ->orderBy('sub_categories.name', 'asc')
            ->get();
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('sub_categories.is_delete', "=", 0)
            ->where('sub_categories.status', "=", 0)
            ->first();
    }
    public function totalProducts()
    {
        return $this->hasMany(Product::class, 'sub_category_id')
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->count();
    }

}
