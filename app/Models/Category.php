<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Brand;

class Category extends Model
{
    use HasFactory;


    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        'is_delete',
        'created_by'


    ];

    static public function getRecord()
    {
        return self::select('categories.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 0)
            ->orderBy('categories.id', 'desc')
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
