<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Brand;

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
        'created_by'


    ];

    static public function getRecord()
    {
        return self::select('sub_categories.*', 'users.name as created_by_name', 'categories.name as category_name')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->orderBy('sub_categories.id', 'desc')
            ->paginate(15);
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function relatedProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->latest()->take(16);
    }
    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id')->where('status', '0');
    }
}
