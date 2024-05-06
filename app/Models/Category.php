<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_by',

    ];

    public static function getRecord()
    {
        return self::select('categories.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 0)
            ->orderBy('categories.id', 'desc')
            ->paginate(15);
    }
    public static function getRecordActive()
    {
        return self::select('categories.*')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 0)
            ->where('categories.status', '=', 0)
            ->orderBy('categories.name', 'asc')
            ->paginate(15);
    }
    public static function getRecordMenu()
    {
        return self::select('categories.*')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 0)
            ->where('categories.status', '=', 0)
            ->get();
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('categories.is_delete', "=", 0)
            ->where('categories.status', "=", 0)
            ->first();
    }
    
    public function getSubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id')
            ->where('sub_categories.is_delete', "=", 0)
            ->where('sub_categories.status', "=", 0);
    }

}
